<?php
class User extends Base {

	public static $RECORD_COUNT = 0;

	const ADMIN_STAFF = '2';
	const ADMIN_STAFF_NAME = 'Admin Staff';

	const MANAGER = '3';
	const MANAGER_NAME = 'Manager';

	const SUPPORT_STAFF = '4';
	const SUPPORT_STAFF_NAME = 'Support Staff';

	const SALES_ADMIN = '12';
	const SALES_ADMIN_NAME = 'Sales Admin';

    function __contruct(){
        parent::__contruct();
    }

	public function login($array){
        if(isset($array) && is_array($array) && count($array) > 0){
            if(!isset($array['email']) || trim($array['email']) == ''){
                Message::addMessage("Please fill your email.");
            } else if(!filter_var($array['email'], FILTER_VALIDATE_EMAIL)){
                Message::addMessage("Please fill valid email.");
            } else if(!isset($array['password']) || trim($array['password']) == ''){
                Message::addMessage("Please fill your password.");
            } else {
                // Take action to check login from Database
                if($result = $this->query("SELECT `id`, `email`, `isActive` FROM `tblUser` WHERE `email` = '" . trim($array['email']) . "' AND `password` = '" . trim($array['password']) . "' AND `isDelete` = 'N'")){
                    if(is_array($result) && count($result) > 0){
                        if(isset($result[0]['isActive']) && $result[0]['isActive'] == 'Y'){
                            $this->setUserLogin($result[0]['id'], $result[0]['email'], (isset($array['remember']) && trim($array['remember'])));
                            Message::addMessage("Login successfully.", SUCCS);
                            return true;
                        }
                        Message::addMessage("Your account is inactive.");
                        return false;
                    }
                }
                Message::addMessage("your email and/or password combination is wrong.");
                return false;
            }
        }
        return false;
    }

    public function setUserLogin($id, $email, $remember = false){
        $_SESSION['admin'] = array(
            'id' => $id,
            'email' => $email
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
		# Implement with Cache control
		$fscKey = FSC::generateCacheKey(array('session' => SESSION_ID, 'id' => $id), 'temp/' . TODAY . '/raw/data/' . C::getCurrentLanguage() . '/misc/User/name/' . SESSION_ID);	// Generate Cache Key
		$name = FSC::retrieve($fscKey, SESSION_START_TIME);	// Retrieve Cached Data

		if(!$name){
			$User = new User();
			if((int)$id > 0 && $result = $User->query("SELECT `TU`.`id`, CONCAT(`TUD`.`firstName`, ' ', `TUD`.`lastName`) AS `name` FROM `tblUser` `TU` INNER JOIN `tblUserDetails` `TUD` ON `TU`.`id` = `TUD`.`id` WHERE `TU`.`id` = '" . $id . "' LIMIT 0, 1")){
				if(is_array($result) && count($result) > 0){
					$name = $result[0]['name'];
				}
			}
			FSC::store($fscKey, $name, 30);	// Cache (with TTL 30)
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
            Message::addMessage("Logout successfully.", SUCCS);
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
                case 'SUPPORT_STAFF':
                return 4;
                break;
                case 'MANAGER':
                return 3;
                break;
                case 'ADMIN_STAFF':
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
                Message::addMessage("Please fill your email.");
            } else if(!filter_var($array['email'], FILTER_VALIDATE_EMAIL)){
                Message::addMessage("Please fill valid email.");
            } else if(!isset($array['password']) || trim($array['password']) == ''){
                Message::addMessage("Please fill your password.");
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
                Message::addMessage("Please fill your email.");
            } else if(!filter_var($array['email'], FILTER_VALIDATE_EMAIL)){
                Message::addMessage("Please fill valid email.");
            } else if(!isset($array['password']) || trim($array['password']) == ''){
                Message::addMessage("Please fill your password.");
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
					Message::addMessage("The email already exists.");
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
            if(isset($array['userName']) && trim($array['userName']) == ''){
                Message::addMessage("Please fill your userName.");
            } else if(isset($array['password']) && trim($array['password']) == ''){
                Message::addMessage("Please fill your password.");
            }else{
                $field = array(
                'userName' => $array['userName'],
                'password' => $array['password']
            );
            $this->login($field);
            }
        }
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
			Message::addMessage("Please fill your email.");
		} else if(!filter_var($array['email'], FILTER_VALIDATE_EMAIL)){
			Message::addMessage("Please fill valid email.");
		} else {
			$result = $this->query("SELECT `id`, `password`, `email` FROM `tblUser`  WHERE `email` = '" . $array['email'] . "'");
			if(isset($result) && is_array($result) && count($result) > 0){
				C::sendEmail($result[0]['email'], 'Forget Password', C::prepareTemplate(EMAIL_TEMPLATES_PATH . '.ht.forgotPassword.tpl', array(
                '{EMAIL}' => $result[0]['email'],
                '{PASSWORD}' => $result[0]['password']
            )));
				return true;
			} else {
				Message::addMessage("This user does not exists.");
				return false;
			}
		}
		return false;
	}

	public function userList($type = 'STAFF', $pagination = false){
		$groupIds = array();
		$where = '';

		switch ($type){
			case 'STAFF' :
			$groupIds[] = $this->getGroupID('ADMIN_STAFF');
			$groupIds[] = $this->getGroupID('MANAGER');
			$groupIds[] = $this->getGroupID('SUPPORT_STAFF');
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
			array(self::ADMIN_STAFF, self::ADMIN_STAFF_NAME),
			array(self::MANAGER, self::MANAGER_NAME),
			array(self::SUPPORT_STAFF, self::SUPPORT_STAFF_NAME)
		);
	}

	public function getDesignationArray(){
		return array(
			array(self::ADMIN_STAFF_NAME, self::ADMIN_STAFF_NAME),
			array(self::MANAGER_NAME, self::MANAGER_NAME),
			array(self::SUPPORT_STAFF_NAME, self::SUPPORT_STAFF_NAME)
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
		// // web
		// $array = array(
		// 	'factoryId' => $Factory->getFactoryIdByOwnerId($id),
		// 	'warehouseId' => $Factory->getWareHouseId('London'), // London
		// 	'embarkmentId' => Location::getCityId('Guangzhou'), // Guangzhou
		// 	'disEmbarkmentId' => '4', // 4
		// 	'exporterId' => '4095',// '4095'
		// 	'notifyPartyId' => '3496', // '3496'
		// 	'consigneeId' => '3497',// '3497'
		// 	'deliveryPlaceId' => '4', // 4
		// );

		//print_r($array);die();
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
				Message::addMessage("Please fill Current Password.");
			} else if(!isset($array['newPassword']) || trim($array['newPassword']) == ''){
				Message::addMessage("Please fill New Password.");
			} else if(!isset($array['confirmNewPassword']) || trim($array['confirmNewPassword']) == ''){
				Message::addMessage("Please Confirm New Password.");
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
								Message::addMessage("Password has been changed.", SUCCS);
								return true;
							}
						} else {
							Message::addMessage("New Password and Confirm Password does not match.");
							return false;
						}
					} else {
						Message::addMessage("New Password and Current Password are same.");
						return false;
					}
				} else {
					Message::addMessage("Current Password does not match.");
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
					Message::addMessage("Action taken successfully.", SUCCS);
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

    public function __destruct(){
        parent::__destruct();
    }
}
