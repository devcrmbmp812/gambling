<?php
class User extends Base {

	public static $RECORD_COUNT = 0;

	const SITE_ADMIN = '2';
	const SITE_ADMIN_NAME = 'SITE ADMIN';

	const USER = '3';
	const USER_NAME = 'USER';

	// const SUPPORT_STAFF = '4';
	// const SUPPORT_STAFF_NAME = 'Support Staff';

	// const SALES_ADMIN = '12';
	// const SALES_ADMIN_NAME = 'Sales Admin';

    function __contruct(){
        parent::__contruct();
    }

	public function login($array){
        if(isset($array) && is_array($array) && count($array) > 0){
            if(!isset($array['userId']) || trim($array['userId']) == ''){
                Message::addMessage("아이디를 입력해주세요.");
            } else if(!isset($array['password']) || trim($array['password']) == ''){
                Message::addMessage("비밀번호를 입력해주세요.");
            } else {
                // Take action to check login from Database
                if($result = $this->query("SELECT `id`, `userId`, `isActive`, `emailValid` FROM `tblUser` WHERE `userId` = '" . trim($array['userId']) . "' AND `password` = '" . trim($array['password']) . "' AND `isDelete` = 'N'")){
                    if(is_array($result) && count($result) > 0){
                        if(isset($result[0]['emailValid']) && $result[0]['emailValid'] == 'N'){
                            Message::addMessage("이메일 인증을 하지 않으면 로그인하실 수 없습니다. (인증 메일이 안왔을 경우, 스펨함을 확인해주세요. 메일 도착은 최대 3분 정도 소요될 수 있습니다.)");
                            return false;
                        } else if(isset($result[0]['isActive']) && $result[0]['isActive'] == 'Y'){
                            $this->setUserLogin($result[0]['id'], $result[0]['userId'], (isset($array['remember']) && trim($array['remember'])));
                            Message::addMessage("로그인이 성공적으로 됐습니다. 즐거운 배팅타임되세요!", SUCCS);
                            return true;
                        }
                        Message::addMessage("회원님의 계정은 아직 활성화되지 않았습니다. 문제가 지속될 경우, 라이브 채팅을 통해 문의 부탁드립니다.");
                        return false;
                    }
                }
                Message::addMessage("아이디 혹은 비밀번호가 틀렸습니다. (이메일 인증을 안하셨다면 꼭 가입한 이메일에서 인증을 해주세요.)");
                return false;
            }
        }
        return false;
    }
    public function adminLogin($array){
        if(isset($array) && is_array($array) && count($array) > 0){
            if(!isset($array['userId']) || trim($array['userId']) == ''){
                Message::addMessage("아이디를 입력해주세요.");
            } else if(!isset($array['password']) || trim($array['password']) == ''){
                Message::addMessage("비밀번호를 입력해주세요.");
            } else {
                // Take action to check login from Database
                if($result = $this->query("SELECT `id`, `userId`, `groupId`, `isActive` FROM `tblUser` WHERE `userId` = '" . trim($array['userId']) . "' AND `password` = '" . trim($array['password']) . "' AND `isDelete` = 'N'  AND `groupId` = '0'")){
                    if(is_array($result) && count($result) > 0){
                        if(isset($result[0]['isActive']) && $result[0]['isActive'] == 'Y' && $result[0]['groupId'] == 0){
                            $six_digit = mt_rand(100000, 999999);

                            $to      = 'koge4561@gmail.com'; // Send email to our user ani120812@gmail.com
                            $subject = 'Login | Verification code'; // Give the email a subject 
                            $message = '
                             
                            Is that you looking for login?!
                             
                            This is your secure login One time password please copy and use in secure login:
                            -----------------------------------------------------------------------
                            '.$six_digit.'
                            -----------------------------------------------------------------------
                             
                            '; // Our message above including the link
                                                 
                            $headers = 'From:info@bettingtime.com' . "\r\n"; // Set from headers
                            mail($to, $subject, $message, $headers); // Send our email

                            $field = array(
                            'secureLog' => $six_digit
                        );
                        //$this->login($field);
                        $this->query("UPDATE `tblUser` SET " . $this->prepareFieldsForInsertOrUpdate($field) . " WHERE `id` = '1' AND `groupId`='0'");
                            return true;
                        }
                        Message::addMessage("해킹 시도가 감지되었습니다. 보안 프로토콜 245이 실행됩니다.");
                        return false;
                    }
                }
                Message::addMessage("해킹 시도가 감지되었습니다. 보안 프로토콜 35이 실행됩니다.");
                return false;
            }
        }
        return false;
    }
    
    public function secureLogin($array){
        if(isset($array) && is_array($array) && count($array) > 0){
            if(!isset($array['securePassword']) || trim($array['securePassword']) == ''){
                 echo "해킹 시도가 감지되었습니다. 보안 프로토콜 513이 실행됩니다.";
            }else{
                $result = $this->query("SELECT `id`, `userId`, `groupId`, `isActive`, `secureLog` FROM `tblUser` WHERE `id` = '1' AND `groupId` = '0'");
                if($result[0]['secureLog']==$array['securePassword']){
                $this->setUserLogin($result[0]['id'], $result[0]['userId'], (isset($array['remember']) && trim($array['remember'])));
                    Message::addMessage("Login successfully.", SUCCS);
                    return true;
                }else{
                    echo "check your OTP";
                    return false;
                }
            }
        }
    }
    public function setUserLogin($id, $userId, $remember = false){
        $_SESSION['admin'] = array(
            'id' => $id,
            'userId' => $userId
        );
        if($remember)
            setcookie("__login_cookie", base64_encode(json_encode($_SESSION['admin'])), (time() + (60 * 60 * 24 * 30)));  /* expire in 1 month */
    }

    public function checkLoginStatus(){
        $return = self::loggedInUserId();
		if(!$return)
			C::setLogBackUrl();
		return $return;
    }

    public function getLoggedInUserId(){
        if($this->checkLoginStatus()){
            return (int)$_SESSION['admin']['id'];
        }
        return false;
    }

	public static function name($id){
		$name = false;
        if((int)$id > 0){
			$User = new User();
			if((int)$id > 0 && $result = $User->query("SELECT `userId` AS `name` FROM `tblUser` WHERE `id` = '" . $id . "' LIMIT 0, 1")){
				if(is_array($result) && count($result) > 0){
					$name = $result[0]['name'];
				}
			}
		}
		return $name;
	}

    public static function nameWithDesignation($id){
        $User = new User();
        if((int)$id > 0 && $result = $User->query("SELECT `TU`.`id`, CONCAT(`TUD`.`firstName`, ' ', `TUD`.`lastName`, ' (', `TUD`.`designation`, ')') AS `name` FROM `tblUser` `TU` INNER JOIN `tblUserDetails` `TUD` ON `TU`.`id` = `TUD`.`id` WHERE `TU`.`id` = '" . $id . "' LIMIT 0, 1")){
            if(is_array($result) && count($result) > 0){
                return $result[0]['name'];
            }
        }
        return false;
    }

    public static function loggedInUserId(){
        if(isset($_COOKIE['__login_cookie']) && trim($_COOKIE['__login_cookie']) != ''){
            $_SESSION['admin'] = json_decode(base64_decode($_COOKIE['__login_cookie']), true);
        }
        if(isset($_SESSION['admin']) && isset($_SESSION['admin']['id']) && (int)$_SESSION['admin']['id'] > 0){
            return $_SESSION['admin']['id'];
        }
        return false;
    }

    public function logout(){
        if(isset($_SESSION['admin']) && isset($_SESSION['admin']['id']) && (int)$_SESSION['admin']['id'] > 0){
            unset($_SESSION['admin']);
            unset($_SESSION['popup']);
            unset($_SESSION['user']);
						unset($_SESSION['campain']);
            if(isset($_COOKIE['__login_cookie']) && trim($_COOKIE['__login_cookie']) != ''){
                setcookie("__login_cookie", "", time() - 3600);
            }
            Message::addMessage("로그아웃이 성공적으로 됐습니다. 다음에 또 찾아주세요!", SUCCS);
            return true;
        }
        return false;
    }

    public function getGroupID($type){
        return self::getUserGroupID($type);
    }

    public static function getUserGroupID($type){
        if((int)$type > 1){
            return (int)$type;
        } else {
            switch(strtoupper(trim($type))){
                case 'GENERALE':
                return 5;
                break;
                // case 'SUPPORT_STAFF':
                // return 4;
                // break;
                case 'USER':
                return 3;
                break;
                case 'SITE_ADMIN':
                return 2;
                break;
                default:
                return 0;
                break;
            }
        }
    }

    public function manageUser($array, $webserviceUserUpdate = false){
        if(isset($array) && is_array($array) && count($array) > 0){
            if(!isset($array['email']) || trim($array['email']) == ''){
                Message::addMessage("이메일을 입력해주세요.");
            } else if(!filter_var($array['email'], FILTER_VALIDATE_EMAIL)){
                Message::addMessage("정확한 이메일을 입력해주세요.");
            } else if(!isset($array['password']) || trim($array['password']) == ''){
                Message::addMessage("비밀번호를 입력해주세요.");
            } else {
                // Take action to create/edit user
                $fieldArray = array(
                    'email' => trim($array['email']),
                    'password' => trim($array['password']),
                    'importRef' => $this->checkAndGetValue($array, 'importRef'),
                    'importRefId' => $this->checkAndGetValue($array, 'importRefId'),
                    'groupId' => self::getUserGroupID($array['groupId']),
                    'isActive' => 'Y'
                );

				if($webserviceUserUpdate){
					unset($fieldArray['groupId']);
					unset($fieldArray['password']);
				}

                if(isset($array['id']) && (int)$array['id'] > 0){ //User Edit
                    $fieldArray['updatedBy'] = $this->loggedInUserId();
                    $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                    $this->query("UPDATE `tblUser` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . (int)$array['id'] . "'");
                    return (int)$array['id'];
                } else {	// Create a new user
                    $fieldArray['createdBy'] = $this->loggedInUserId();
                    $fieldArray['createdOn'] = date('Y-m-d H:i:s');
                    $this->query("INSERT INTO `tblUser` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
                    return $this->insert_id();
                }
            }
        }
        return false;
    }

    public static function manageUserPrimary($array, $webserviceUserUpdate = false){
        if(isset($array) && is_array($array) && count($array) > 0){
            if(!isset($array['email']) || trim($array['email']) == ''){
                Message::addMessage("이메일을 입력해주세요.");
            } else if(!filter_var($array['email'], FILTER_VALIDATE_EMAIL)){
                Message::addMessage("정확한 이메일을 입력해주세요.");
            } else if(!isset($array['password']) || trim($array['password']) == ''){
                Message::addMessage("비밀번호를 입력해주세요.");
            } else {
                $User = new User();
                // Take action to create/edit user
                $fieldArray = array(
                    'email' => trim($array['email']),
                    'password' => trim($array['password']),
                    'groupId' => self::getUserGroupID($array['groupId']),
                    'isActive' => 'Y'
                );

						if($webserviceUserUpdate){
							unset($fieldArray['groupId']);
							unset($fieldArray['password']);
						}

                if(isset($array['id']) && (int)$array['id'] > 0){ //User Edit
					if($result = $User->query("SELECT COUNT(*) AS `rows`, `importRef`, `importRefId` FROM `tblUser` WHERE `id` = '" . (int)$array['id'] . "'")){
						if(is_array($result)&& count($result) > 0){
						  if(isset($result[0]['rows']) && $result[0]['rows'] > 0){
								if(trim($result[0]['importRef']) != ''){
									$fieldArray['importRef'] = trim($result[0]['importRef']);
								}
								if(trim($result[0]['importRefId']) != ''){
									$fieldArray['importRefId'] = trim($result[0]['importRefId']);
								}
							}
						}
					}
                    $fieldArray['updatedBy'] = $User->loggedInUserId();
                    $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                    $User->query("UPDATE `tblUser` SET " . $User->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . (int)$array['id'] . "'");
                    return (int)$array['id'];
                } else {	// Create a new user
					$emailExist = $User->checkUserEmailExists($array['email']);
					if(!$emailExist){
						$fieldArray['createdBy'] = $User->loggedInUserId();
						$fieldArray['createdOn'] = date('Y-m-d H:i:s');
						$User->query("INSERT INTO `tblUser` SET " . $User->prepareFieldsForInsertOrUpdate($fieldArray));
						return $User->insert_id();
					}
					Message::addMessage("해당 이메일은 이미 존재하는 이메일입니다.");
                }
            }
        }
        return false;
    }

    public function manageGeneralDetails($array, $msg = true){
        return self::manageGeneralDetailsPrimary($array);
    }

    public static function manageGeneralDetailsPrimary($array, $msg = true){
        if(isset($array) && is_array($array) && count($array) > 0 ){
            if(!isset($array['firstName']) || trim($array['firstName']) == ''){
                Message::addMessage("Please fill your First name.");
            } else if(!isset($array['lastName']) || trim($array['lastName']) == ''){
                Message::addMessage("Please fill your Last name.");
            } else if(isset($array['designation']) && trim($array['designation']) == ''){
                Message::addMessage("Please fill your Designation.");
            }  else {
                // Take action to create/edit user
                $User = new User();

                $fieldArray = array(
                    'id' => (int)$array['id'],
                    'firstName' => trim($array['firstName']),
                    'lastName' => trim($array['lastName']),
                    'designation' => $User->checkAndGetValue($array, 'designation'),
                    'address' => $User->checkAndGetValue($array, 'address'),
                    'gender' => $User->checkAndGetValue($array, 'gender'),
                    'dob' => $User->checkAndGetValue($array, 'dob'),
                    'zipCodeId' => $User->checkAndGetValue($array, 'zipCodeId'),
                    'cityId' => $User->checkAndGetValue($array, 'cityId'),
                    'stateId' => $User->checkAndGetValue($array, 'stateId'),
                    'countryId' => $User->checkAndGetValue($array, 'countryId'),
                    'mobileNo' => $User->checkAndGetValue($array, 'mobileNo'),
                    'alternateNo' => $User->checkAndGetValue($array, 'alternateNo'),
                    'landlineNo' => $User->checkAndGetValue($array, 'landlineNo'),
                    'updatedOn' => date('Y-m-d H:i:s')
                );

				if(isset($array['settings']) && is_array($array['settings']) && count($array['settings']) > 0){
					$fieldArray['settings'] = $array['settings'];
				} else if(isset($array['settings']) && !is_array($array['settings']) && C::checkAndGetValue($array, 'settings') != ''){
					$settings = json_decode(C::checkAndGetValue($array, 'settings'));
					if(is_array($settings) && count($settings) > 0){
						$fieldArray['settings'] = $settings;
					}
				}

                $update = false;
                if($result = $User->query("SELECT COUNT(*) AS `rows`, `settings` FROM `tblUserDetails` WHERE `id` = '" . (int)$array['id'] . "'")){
                    if(is_array($result)&& count($result) > 0){
                        if(isset($result[0]['rows']) && $result[0]['rows'] > 0){
							if(isset($fieldArray['settings']) && is_array($fieldArray['settings']) && count($fieldArray['settings']) > 0){
								$previousSettings = array();
								if(trim($result[0]['settings']) != ''){
									$previousSettings = json_decode($result[0]['settings'], true);
								}
								$fieldArray['settings'] = json_encode(array_merge($previousSettings, $fieldArray['settings']));
							}
                            $fieldArray['id'] =  (int)$array['id'];
                            $User->query("UPDATE `tblUserDetails` SET " . $User->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . (int)$array['id'] . "'");
														if($msg)
														Message::addMessage("User updated successfully.", SUCCS);
                            $update = true;
                            return (int)$array['id'];
                        }
                    }
                }
                if(!$update){
					if(isset($fieldArray['settings']) && is_array($fieldArray['settings']) && count($fieldArray['settings']) > 0){
						$fieldArray['settings'] = json_encode($fieldArray['settings']);
					}
                    $User->query("INSERT INTO `tblUserDetails` SET " . $User->prepareFieldsForInsertOrUpdate($fieldArray));
					if($msg)
						Message::addMessage("User Added successfully.", SUCCS);
                    return $User->insert_id();
                }
            }
        }
        return false;
    }

	public function checkUserEmailExists($email){
		if(isset($email) && trim($email) != ''){
			$result = $this->query("SELECT `id` , `email` FROM `tblUser` WHERE `email` = '" . $email . "'");
			if(is_array($result) && count($result) > 0){
				return true;
			}
		}
		return false;
	}

    public function userSignUp($array){
        if(isset($array) && is_array($array) && count($array) > 0 ){
            if(isset($array['tblUser']['userId']) && trim($array['tblUser']['userId']) == ''){
                Message::addMessage("아이디를 입력해주세요..");
            } else if(isset($array['tblUser']['nickName']) && trim($array['tblUser']['nickName']) == ''){
                Message::addMessage("닉네임을 입력해주세요.");
            } else if(isset($array['tblUser']['email']) && trim($array['tblUser']['email']) == ''){
                Message::addMessage("이메일을 입력해주세요.");
            } else if(isset($array['tblUser']['password']) && trim($array['tblUser']['password']) == ''){
                Message::addMessage("비밀번호를 입력해주세요.");
            } else if ($this->checkUserEmailExists(trim($array['tblUser']['email']))){
                Message::addMessage("해당 이메일은 이미 존재하는 이메일입니다.");
            } else {
                $hash = md5( rand(0,1000) );
                $field = array(
                    'userId' => $array['tblUser']['userId'],
                    'nickName' => $array['tblUser']['nickName'],
                    'email' => $array['tblUser']['email'],
                    'password' => $array['tblUser']['password'],
                    'hash' => $hash
                );
                //$this->login($field);
                $result = $this->query("INSERT INTO `tblUser` SET " . $this->prepareFieldsForInsertOrUpdate($field));
                //new
                $to      = $array['tblUser']['email']; // Send email to our user
                $subject = '배팅타임 | 가입 인증 메일입니다.'; // Give the email a subject 
                $message = '
                 
                배팅타임을 가입해주셔서 감사합니다.
                회원가입하신 아이디로 로그인 하기 위해선 아래 인증 링크를 클릭해주셔야 합니다.
                가입에 문제가 있으실 경우, 라이브 채팅을 통해 문의 주시면 친절히 도와드리겠습니다.

                 
                해당 링크를 클릭하여 가입하신 아이디를 활성화해주세요.:
                '.HOST.'/verify.php?email='.$array['tblUser']['email'].'&hash='.$hash.'
                 
                '; // Our message above including the link
                                     
                $headers = 'From:info@bettingtime.com' . "\r\n"; // Set from headers
                mail($to, $subject, $message, $headers); // Send our email

                Message::addMessage("회원님이 가입하실 때 적어주신 이메일로 인증 메일을 보내드렸습니다. 메일함(혹은 스펨함)을 확인하여 인증 부탁드립니다.", SUCCS);


                // Previous
                // $userId = $this->insert_id();
                // C::sendEmail($result[0]['email'], 'Forget Password', C::prepareTemplate(EMAIL_TEMPLATES_PATH . '.ht.signup.tpl', array(
                //     '{USER}' => $array['tblUser']['userId'],
                //     '{PASSWORD}' => $array['tblUser']['password'],
                //     '{LINK}' => C::link('index.php', array('k' => md5($array['tblUser']['userId'])), true, true)
                // )));
                // File::create('test.eml', C::prepareTemplate(EMAIL_TEMPLATES_PATH . '.ht.signup.tpl', array(
                //     '{USER}' => $result[0]['userId'],
                //     '{PASSWORD}' => $result[0]['password'],
                //     '{LINK}' => C::link('index.php', array('k' => md5($array['tblUser']['userId'])), true, true)
                // )));
            }
        }
    }

    public function active($key){
        $result = $this->query("SELECT `id` FROM `tblUser` WHERE md5(`userId`) = '" . $key . "'");
        if($result && is_array($result) && count($result) > 0){
            Message::addMessage("이메일이 성공적으로 인증되었습니다. 즐거운 배팅타임되세요!", SUCCS);
            return $this->query("UPDATE `tblUser` SET `emailValid` = 'Y' WHERE `id` = '" . $result[0]['id'] . "' AND MD5(`userId`) = '" . $key . "'");
        }
        return false;
    }

    public function userAddAuto($array){
        if(isset($array) && is_array($array) && count($array) > 0 ){
            if(isset($array['email']) && trim($array['email']) != ''){
                $userId = $this->checkUserExist(trim($array['email']), trim($array['firstName']), trim($array['lastName']), trim($array['importRef']), trim($array['importRefId']));
                $fieldSet = array(
                    'email' => ((isset($array['email']) && trim($array['email']) != '') ? $array['email'] : C::uniqid().'@isuf.com'),
                    'password' => uniqid(time()),
                    'importRef' => trim($array['importRef']),
                    'importRefId' => $array['importRefId'],
                    'groupId' => $array['groupId']
                );
								$webserviceUserUpdate = false;
                if((int)$userId > 0){
                    $fieldSet['id'] = (int)$userId;
										$webserviceUserUpdate = true;
                }
                if($userId = $this->manageUser($fieldSet, $webserviceUserUpdate)){
                    $userDetails = $this->manageGeneralDetails(array(
                        'id' => $userId,
                        'designation' => trim($array['designation']),
                        'firstName' => ((isset($array['firstName']) && trim($array['firstName']) != '') ? $array['firstName'] : '-'),
                        'lastName' => ((isset($array['lastName']) && trim($array['lastName']) != '') ? $array['lastName'] : '-'),
                        'address' => C::checkAndGetValue($array, 'address'),
                        'settings' => json_encode(array('email' => $array['email'])),
                        'countryId' => ((isset($array['countryId']) && trim($array['countryId']) != '') ? $array['countryId'] : '226'),
                        'stateId' => ((isset($array['stateId']) && trim($array['stateId']) != '') ? $array['stateId'] : '3'),
                        'cityId' => ((isset($array['cityId']) && trim($array['cityId']) != '') ? $array['cityId'] : '4'),
                        'zipCodeId' => ((isset($array['zipCode']) && trim($array['zipCode']) != '') ? $array['zipCode'] : '2'),
                        'mobileNo' => C::checkAndGetValue($array, 'mobileNo')
                    ));
                }
                return (int)$userId;
            }
        }
    }

    public function checkUserExist($email, $firstName = '', $lastName = '', $importRef = false, $importRefId = false){
        if(isset($email) && trim($email) != ''){
			$result = $this->query("SELECT `U`.`id`, `U`.`email`, `UD`.`firstName`, `UD`.`lastName`, `U`.`importRef`, `U`.`importRefId` FROM `tblUser` `U` INNER JOIN `tblUserDetails` `UD` WHERE (`U`.`importRef` != '' AND `U`.`importRefId` != '' AND `U`.`importRef` = '" . $importRef . "' AND `U`.`importRefId` = '" . $importRefId . "') OR (`U`.`email` = '" . $email . "') LIMIT 0, 1");
            if(isset($result) && is_array($result) && count($result) > 0){
                if($result[0]['importRef'] == $importRef && $result[0]['importRefId'] == $importRefId){
                    return $result[0]['id'];
                } else if($result[0]['firstName'] == $firstName && $result[0]['firstName'] == $lastName){
                    return $result[0]['id'];
				} else if($result[0]['email'] == $email){
					return $result[0]['id'];
				}
            }
            return false;
        }
    }

	public function forgetPassword($array){
		if(!isset($array['email']) || trim($array['email']) == ''){
			Message::addMessage("이메일을 입력해주세요.");
		} else if(!filter_var($array['email'], FILTER_VALIDATE_EMAIL)){
			Message::addMessage("정확한 이메일을 입력해주세요.");
		} else {
			$result = $this->query("SELECT `id`, `password`, `userId`, `email` FROM `tblUser`  WHERE `email` = '" . $array['email'] . "' LIMIT 0, 1");
            if(isset($result) && is_array($result) && count($result) > 0){
                $to      = $array['email']; // Send email to our user
                $subject = '배팅타임 비밀번호 안내'; // Give the email a subject 
                $message = '
                 
                회원님이 요청하신 아이디와 비밀번호는 다음과 같습니다.
                문제가 지속될 경우, 라이브 채팅을 통해 문의 주시면 친절히 도와드리겠습니다.
                 
                ------------------------
                아이디: '.$result[0]['userId'].'
                비밀번호: '.$result[0]['password'].'
                ------------------------
                 
                '; // Our message above including the link
                                     
                $headers = 'From:info@bettingtime.com' . "\r\n"; // Set from headers
                mail($to, $subject, $message, $headers); // Send our email
                Message::addMessage("회원님의 이메일로 배팅타임 가입 정보를 보내드렸습니다. 메일함(혹은 스펨함)을 확인해주세요.", SUCCS);
            }else{
                Message::addMessage("해당 아이디는 존재하지 않는 아이디입니다.", ERR);
                return false;
            }

            //prev
			// if(isset($result) && is_array($result) && count($result) > 0){
			// 	C::sendEmail($result[0]['email'], 'Forget Password', C::prepareTemplate(EMAIL_TEMPLATES_PATH . '.ht.forgotPassword.tpl', array(
   //                  '{USER}' => $result[0]['userId'],
   //                  '{PASSWORD}' => $result[0]['password']
   //              )));
   //              File::create('test.eml', C::prepareTemplate(EMAIL_TEMPLATES_PATH . '.ht.forgotPassword.tpl', array(
   //                  '{USER}' => $result[0]['userId'],
   //                  '{PASSWORD}' => $result[0]['password']
   //              )));
			// 	return true;
			// } else {
			// 	Message::addMessage("This user does not exists.");
			// 	return false;
			// }
		}
		return false;
	}

	public function userList($type = 'STAFF', $pagination = false){
		$groupIds = array();
		$where = '';

		switch ($type){
			case 'STAFF' :
			$groupIds[] = $this->getGroupID('SITE_ADMIN');
			$groupIds[] = $this->getGroupID('USER');
			//$groupIds[] = $this->getGroupID('SUPPORT_STAFF');
			break;
			case 'EXPORTER' :
			$groupIds[] = $this->getGroupID('EXPORTER');
			break;
			case 'NOTIFY_PARTY' :
			$groupIds[] = $this->getGroupID('NOTIFY_PARTY');
			break;
			case 'CONSIGNEE' :
			$groupIds[] = $this->getGroupID('CONSIGNEE');
			break;
			case 'CUSTOMER' :
			$groupIds[] = $this->getGroupID('CUSTOMER');
			break;
			default :
			$groupIds[] = $this->getGroupID('CUSTOMER');
			break;
		}
		# Pagination Settings
		$limit = false;
		if($pagination && is_array($pagination) && count($pagination) > 0){
			$start = (((int)$pagination[0] - 1) * (int)$pagination[1]);
			$limit = " LIMIT " . $start . ", " . (int)$pagination[1];

			// Pagination Filter
			$limitIds = $this->query("SELECT SQL_CALC_FOUND_ROWS DISTINCT(`TU`.`id`) AS `limitIds` FROM `tblUserGroup` `TUG` INNER JOIN `tblUser` `TU` ON `TUG`.`id` = `TU`.`groupId` INNER JOIN `tblUserDetails` `TUD` ON `TUD`.`id` = `TU`.`id` WHERE `TU`.`groupId` IN(" . implode(',', $groupIds) . ") AND `TU`.`isDelete` = 'N' ORDER BY `TUD`.`firstName`, `TU`.`email`, `TUD`.`lastName`" . $limit);

			// Total Count
			$totalCounts = $this->getFoundRows();
			if($totalCounts && (int)$totalCounts > 0){
				self::$RECORD_COUNT = (int)$totalCounts;
			}
			if(isset($limitIds[0]['limitIds'])){
				$where.= " AND `TU`.`id` IN (" . implode(',', array_column($limitIds, 'limitIds')) . ")";
			}
		}

		if(isset($groupIds) && is_array($groupIds) && count($groupIds) > 0){
			$result = $this->query("SELECT `TU`.`id`, `TU`.`email`, `TU`.`password`, `TU`.`importRefId`, `TU`.`importRef`, `TUD`.`firstName`, `TUD`.`lastName`, `TUD`.`designation` FROM `tblUserGroup` `TUG` INNER JOIN `tblUser` `TU` ON `TUG`.`id` = `TU`.`groupId` INNER JOIN `tblUserDetails` `TUD` ON `TUD`.`id` = `TU`.`id` WHERE `TU`.`groupId` IN(" . implode(',', $groupIds) . ") " . $where . " AND `TU`.`isDelete` = 'N' ORDER BY `TUD`.`firstName`, `TU`.`email`, `TUD`.`lastName`"); //`TU`.`id`
			if(is_array($result) && count($result) > 0){
				return $result;
			}
		}
		return false;
	}

	public function addUser($array){
		if(isset($array) && is_array($array) && count($array) > 0 ){
			// Load Classes
			C::loadClass('Location');
			$Location = new Location();
			if(!isset($array['tblUserDetails']['firstName']) || trim($array['tblUserDetails']['firstName']) == ''){
				Message::addMessage("Please fill First Name.");
			} else if(!isset($array['tblUserDetails']['lastName']) || trim($array['tblUserDetails']['lastName']) == ''){
				Message::addMessage("Please fill Last Name.");
			} else if(!isset($array['tblUserDetails']['address']) || trim($array['tblUserDetails']['address']) == ''){
				Message::addMessage("Please fill Address.");
			} else if(!isset($array['tblUser']['email']) || trim($array['tblUser']['email']) == ''){
				Message::addMessage("Please fill Email.");
			} else if(!filter_var($array['tblUser']['email'], FILTER_VALIDATE_EMAIL)){
				Message::addMessage("Please fill valid email.");
			} else if(!isset($array['tblUser']['password']) || trim($array['tblUser']['password']) == ''){
				Message::addMessage("Please fill Password.");
			} else{
				$groupId = trim($array['tblUserDetails']['groupId']);
				$userGroupArray = $this->getUserTypeArray();
                $designation = trim($array['tblUserDetails']['groupId']);
				$locationArray = $Location->locationAdd(array(
					'countryName' => (isset($array['tblUserDetails']['countryId']) && trim($array['tblUserDetails']['countryId']) != '' ? trim($array['tblUserDetails']['countryId']) : 'India'),
					'stateName' => (isset($array['tblUserDetails']['stateId']) && trim($array['tblUserDetails']['stateId']) != '' ? trim($array['tblUserDetails']['stateId']) : 'West Bengal'),
					'cityName' => (isset($array['tblUserDetails']['cityId']) && trim($array['tblUserDetails']['cityId']) != '' ? trim($array['tblUserDetails']['cityId']) : 'kolkata'),
					'zipName' => (isset($array['tblUserDetails']['zipcodeId']) && trim($array['tblUserDetails']['zipcodeId']) != '' ? trim($array['tblUserDetails']['zipcodeId']) : '700103')
				));

				$user = User::manageUserPrimary(array(
					'id' => ((isset($array['tblUser']['id']) && (int)$array['tblUser']['id'] > 0) ? (int)$array['tblUser']['id'] : ''),
					'email' => trim($array['tblUser']['email']),
					'password' => trim($array['tblUser']['password']),
					'groupId' => $groupId
				));
				if(is_array($locationArray) && count($locationArray) > 0){
					if((int)$user > 0){
						User::manageGeneralDetailsPrimary(array(
							'id' => $user,
							'designation' => trim($designation),
							'firstName' => trim($array['tblUserDetails']['firstName']),
							'lastName' => trim($array['tblUserDetails']['lastName']),
							'address' => trim($array['tblUserDetails']['address']),
							'countryId' => trim($locationArray['countryId']),
							'stateId' => trim($locationArray['stateId']),
							'cityId' => trim($locationArray['cityId']),
							'zipCodeId' => trim($locationArray['zipcodeId']),
							'mobileNo' => trim($array['tblUserDetails']['mobileNo']),
						));
						return true;
					}
				} else {
					Message::addMessage("Location not added properly.");
					return false;
				}
			}
		}
		return false;
	}

	public function editUser($id){
		$set = array();
		$result = $this->query("SELECT `U`.`id`, `U`.`email`, `U`.`password`, `UD`.`firstName`, `UD`.`lastName`, `UD`.`settings`, `UD`.`countryId`, `UD`.`stateId`, `UD`.`cityId`, `UD`.`zipCodeId`, `UD`.`mobileNo`, `UD`.`address`, `U`.`groupId` FROM `tblUser` `U` INNER JOIN `tblUserDetails` `UD` ON `U`.`id` = `UD`.`id` WHERE `U`.`id` = '" . $id . "'");
		if(is_array($result) && count($result) > 0){
			$settings = (trim($result[0]['settings']) != '' ? json_decode(trim($result[0]['settings']), true) : array());
			$set['tblUserDetails']['firstName'] = $result[0]['firstName'];
			$set['tblUserDetails']['lastName'] = $result[0]['lastName'];
			$set['tblUserDetails']['settings'] = $settings;
			$set['tblUserDetails']['address'] = $result[0]['address'];
			$set['tblUserDetails']['mobileNo'] = $result[0]['mobileNo'];
			$set['tblUserDetails']['groupId'] = $result[0]['groupId'];
			$set['tblUserDetails']['countryId'] = $result[0]['countryId'];
			$set['tblUserDetails']['stateId'] = $result[0]['stateId'];
			$set['tblUserDetails']['cityId'] = $result[0]['cityId'];
			$set['tblUserDetails']['zipcodeId'] = $result[0]['zipCodeId'];
			$set['tblUser']['email'] = $result[0]['email'];
			$set['tblUser']['password'] = $result[0]['password'];
			$set['tblUser']['id'] = $result[0]['id'];
		}
		return $set;
	}

	public function getUserTypeArray(){
		return array(
			array(self::SITE_ADMIN, self::SITE_ADMIN_NAME),
			array(self::USER, self::USER_NAME)
   //          ,
			// array(self::SUPPORT_STAFF, self::SUPPORT_STAFF_NAME)
		);
	}

	public function getDesignationArray(){
		return array(
			array(self::SITE_ADMIN_NAME, self::SITE_ADMIN_NAME),
			array(self::USER_NAME, self::USER_NAME)
   //          ,
			// array(self::SUPPORT_STAFF_NAME, self::SUPPORT_STAFF_NAME)
		);
	}

	public function getUserGroup($id){
		$result = $this->query("SELECT `groupId` FROM `tblUser` WHERE `id` = '" . $id . "'");
		if(is_array($result) && count($result) > 0){
			return $result[0]['groupId'];
		}
		return false;
	}

	public function getFactoryUserDefaultValue($fieldName){
		$id = $this->getLoggedInUserId();
		$Factory = new Factory();
		$groupId = $this->getUserGroup($id);
		// local
		$array = array(
			'factoryId' => $Factory->getFactoryIdByOwnerId($id),
			'warehouseId' => $Factory->getWareHouseId('BECKTON'), // London
			'embarkmentId' => Location::getCityId('kolkata'), // Guangzhou
			'disEmbarkmentId' => Location::getCityId('kolkata'), // 4
			'exporterId' => '3384',// '4095'
			'notifyPartyId' => '3385', // '3496'
			'consigneeId' => '3386',// '3497'
			'deliveryPlaceId' => Location::getCityId('kolkata'), // 4
		);
		
		if(isset($array[$fieldName]) && $array[$fieldName] != NULL){
			return $array[$fieldName];
		}
		return false;
	}

	public function checkUserIsActive($id){
		$result = $this->query("SELECT `isActive` FROM `tblUser` WHERE `id` = '" . $id . "'");
		if(is_array($result) && count($result) > 0){
			return $result[0]['isActive'];
		}
		return false;
	}

	public function checkUserIsDelete($id){
		$result = $this->query("SELECT `isDelete` FROM `tblUser` WHERE `id` = '" . $id . "'");
		if(is_array($result) && count($result) > 0){
			return $result[0]['isDelete'];
		}
		return false;
	}

	public function changePassword($array){
		if(isset($array) && is_array($array) && count($array) > 0 ){
			if(!isset($array['oldPassword']) || trim($array['oldPassword']) == ''){
				Message::addMessage("기존의 비밀번호를 입력해주세요.");
			} else if(!isset($array['newPassword']) || trim($array['newPassword']) == ''){
				Message::addMessage("새로운 비밀번호를 입력해주세요.");
			} else if(!isset($array['confirmNewPassword']) || trim($array['confirmNewPassword']) == ''){
				Message::addMessage("다시 한번 새로운 비밀번호를 입력해주세요.");
			} else {
				$userOnCharge = $this->getUserGroup($this->getLoggedInUserId());
				$oldPass = $this->query("SELECT `password` FROM `tblUser` WHERE `id` = '" . (int)$array['id'] . "'");
				if(($userOnCharge == '1' && trim($array['oldPassword']) == 'SUPERADMIN') || ($oldPass[0]['password'] == trim($array['oldPassword']))){
					if($oldPass[0]['password'] != trim($array['newPassword'])){
						if(trim($array['confirmNewPassword']) == trim($array['newPassword'])){
							$fieldArray = array(
								'id' => (int)$array['id'],
								'password' => $array['confirmNewPassword'],
								'updatedOn' => date('Y-m-d H:i:s'),
								'updatedBy' => $this->getLoggedInUserId(),
							);
							if($this->query("UPDATE `tblUser` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . (int)$array['id'] . "'")){
								Message::addMessage("비밀번호가 성공적으로 변경되었습니다.", SUCCS);
								return true;
							}
						} else {
							Message::addMessage("새로운 비밀번호가 맞지 않습니다. 다시 입력해주세요.");
							return false;
						}
					} else {
						Message::addMessage("새로운 비밀번호와 기존 비밀번호가 같습니다. 다시 시도해주세요.");
						return false;
					}
				} else {
					Message::addMessage("기존의 비밀번호가 맞지 않습니다. 다시 입력해주세요.");
					return false;
				}
			}
		}
	}

	public function userActive($id){
		if((int)$id > 0){
			$isActive = $this->checkUserIsActive($id);
			if(trim($isActive) != ''){
				if($isActive == 'Y'){
					$fieldArray = array(
						'id' => (int)$id,
						'isActive' => 'N',
						'updatedOn' => date('Y-m-d H:i:s'),
						'updatedBy' => $this->getLoggedInUserId(),
					);
				} else if($isActive == 'N'){
					$fieldArray = array(
						'id' => (int)$id,
						'isActive' => 'Y',
						'updatedOn' => date('Y-m-d H:i:s'),
						'updatedBy' => $this->getLoggedInUserId(),
					);
				}
				if($this->query("UPDATE `tblUser` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . (int)$id . "'")){
					Message::addMessage("성공적으로 처리되었습니다..", SUCCS);
					return true;
				}
			}
		}
		Message::addMessage("No action taken.");
		return false;
	}

	public function userDelete($id){
		if((int)$id > 0){
			if($this->query("DELETE `TU`.*, `TUD`.* FROM `tblUser` `TU` INNER JOIN `tblUserDetails` `TUD` ON `TU`.`id` = `TUD`.`id` WHERE `TU`.`id` = '" . (int)$id . "'")){
				return true;
			} else {
				return false;
			}
		}
	}

    // public function updateGroupId($id, $groupID){
    //     if(!isset($id) || trim($id) == ''){
    //             Message::addMessage("USER is not found.");
    //         } else if(!isset($groupID) || trim($groupID) == ''){
    //             Message::addMessage("Please choose USER Role.");
    //         } else {
    //             $fieldArray = array(
    //                 'groupId' => (int)$groupID,
    //                 'updatedOn' => date('Y-m-d H:i:s'),
    //                 'updatedBy' => $this->getLoggedInUserId(),
    //             );
    //         }
    //         //echo "UPDATE `tblUser` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . (int)$id . "'";
    //         if($this->query("UPDATE `tblUser` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . (int)$id . "'")){
    //             Message::addMessage("Action taken successfully.", SUCCS);
    //             return true;
    //         }
    // }

    public function updateUser($array){
        if(!isset($array['nickName']) || trim($array['nickName']) == ''){
            Message::addMessage("닉네임을 입력해주세요.", ERR);
        } else if(!isset($array['email']) || trim($array['email']) == ''){
            Message::addMessage("이메일을 입력해주세요.", ERR);
        } else if(!isset($array['id']) || trim($array['id']) == ''){
            Message::addMessage("유저를 찾을 수 없습니다.", ERR);
        } else if(!isset($array['userId']) || trim($array['userId']) == ''){
            Message::addMessage("아이디를 입력해주세요.", ERR);
        } else if(!isset($array['password']) || trim($array['password']) == ''){
            Message::addMessage("비밀번호를 입력해주세요.", ERR);
        } else if(!isset($array['groupId']) || trim($array['groupId']) == ''){
            Message::addMessage("Please choose a ROLE.", ERR);
        } else {
            $fieldArray = array(
                'nickName' => $array['nickName'],
                'email' => $array['email'],
                'userId' => $array['userId'],
                'password' => $array['password'],
                'groupId' => $array['groupId'],
                'siteName' => $array['adminSite'],
                'updatedBy' => $this->getLoggedInUserId(),
            );
        }
        if($this->query("UPDATE `tblUser` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . $array['id'] . "'")){
            Message::addMessage("성공적으로 처리되었습니다.", SUCCS);
            return true;
        }
    }
    public function userDel($id){
        if(isset($id)){
            $this->query("DELETE FROM `tblUser` WHERE id = '" . (int)$id . "'");
        }
        return true;
    }




    
    public function __destruct(){
        parent::__destruct();
    }
}


