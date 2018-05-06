<?php
class Card extends Base {
  function __contruct(){
	parent::__contruct();
	}

    /*SPORTS CARD*/
    public function inserBonusCard($array, $file){
        if(!isset($array['bonusName']) || trim($array['bonusName']) == ''){
            echo "Please fill card Name.";
        } else if(!isset($array['joinCode']) || trim($array['joinCode']) == ''){
            echo "Please fill join Code.";
        } else if(!isset($array['sportsName']) || trim($array['sportsName']) == ''){
            echo "Please select Sports Name.";
        } else if(!isset($array['bonusCode']) || trim($array['bonusCode']) == ''){
            echo "Please fill Bonus Code.";
        } else if(!isset($array['bonustype']) || trim($array['bonustype']) == ''){
            echo "Please fill Bonus Type.";
        } else if(!isset($array['bonusAmount']) || trim($array['bonusAmount']) == ''){
            echo "Please fill Bonus Amount.";
        } else if(!isset($array['bonusDesc']) || trim($array['bonusDesc']) == ''){
            echo "Please fill Bonus Description.";
        } else if(!isset($array['wageringRequirements']) || trim($array['wageringRequirements']) == ''){
            echo "Please fill Wagering Requirements.";
        } else if(!isset($array['link']) || trim($array['link']) == ''){
            echo "Please fill Site URL.";
        } else if(!isset($array['imageName']) || trim($array['imageName']) == ''){
            echo "Please fill Image Name.";
        } else if(!isset($array['addBonusDetailsLabel']) || is_array($array['addBonusDetailsLabel']) == ''){
            echo "Please fill atleast One Other Details.";
        } else if(!isset($array['addBonusDetailsValue']) || is_array($array['addBonusDetailsValue']) == ''){
            echo "Please fill atleast One Other Details.";
        } else if(!isset($array['categoryType']) || trim($array['categoryType']) == ''){
            echo "Please fill Category of Sports.";
        } else if(!isset($array['rate']) || trim($array['rate']) == ''){
            echo "Please rate.";
        } else {

        if(isset($file) && is_array($file) && count($file) > 0 && (int)$file['bonusImage']['size'] > 0){
            $uploadOk = 1;
            $temp_name = $file['bonusImage']['tmp_name'];
            $get_ext = explode(".", strtolower($file['bonusImage']['name']));
            $the_file = $array['imageName'];
            $the_file = str_replace(' ', '_', $the_file) . "." . $get_ext[1];
            $directory = ROOT . "images";
            $target_file = $directory . "/bonus/" . $the_file;

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            if($get_ext[1] != "jpg" && $get_ext[1] != "png" && $get_ext[1] != "jpeg" && $get_ext[1] != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                die();
            }else{
                if(move_uploaded_file($temp_name, $target_file)){
                    $the_message = "file uploaded successfully";
                    $filePath = $target_file;
                    chmod($filePath, 0777);
                }else{
                    $the_error = $file['bonusImage']['error']; 
                    $the_message = $upload_errors[$the_error];
                }
            }
        }
        $detail = json_encode($array['addBonusDetailsLabel']) . '+' . json_encode($_POST['addBonusDetailsValue']);

        // Take action to create/edit
        $fieldArray = array(
            'bonusName' => trim($array['bonusName']),
            'joinCode' => trim($array['joinCode']),
            'sportsName' => trim($array['sportsName']),
            'bonusCode' => trim($array['bonusCode']),
            'bonustype' => trim($array['bonustype']),
            'bonusAmount' => trim($array['bonusAmount']),
            'description' => trim($array['bonusDesc']),
            'wageringRequirements' => trim($array['wageringRequirements']),
            'link' => trim($array['link']),
            'imageName' => trim($the_file),
            'isPopular' => trim($array['categoryType']),
            'bonusOtherDetails' => trim($detail),
            'rating' => trim($array['rate']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
        );
            if(trim($filePath) != ''){
                $fieldArray['bonusImage'] = HOST . "images/bonus/" . $fieldArray['imageName'] ;
            }
            $update = false;
            if(!$update){ // Create new
                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                $this->query("INSERT INTO `tblBonusCards` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
            }  
        }
    }
    public function delBonusCard($getId){
        if(isset($getId)){
            $this->query("DELETE FROM `tblBonusCards` WHERE id = $getId");
        }
        return true;
    }
    public function updateBonusCard($array){
        $fieldArray = array(
            'bonusName' => trim($array['bonusName']),
            'joinCode' => trim($array['joinCode']),
            'sportsName' => trim($array['sportsName']),
            'bonusCode' => trim($array['bonusCode']),
            'bonustype' => trim($array['bonustype']),
            'bonusAmount' => trim($array['bonusAmount']),
            'description' => trim($array['bonusDesc']),
            'wageringRequirements' => trim($array['wageringRequirements']),
            'link' => trim($array['link']),
            'isPopular' => trim($array['categoryType']),
            'rating' => trim($array['rate']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
        );
        $update = false;
        if(!$update){ // Create new
            $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
            $this->query("UPDATE `tblBonusCards` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . $array['id'] . "'");
        } 
        return true;
    }



    /*WEB CARD*/
    public function inserWebCard($array, $file){
        if(!isset($array['sportsName']) || trim($array['sportsName']) == ''){
            echo "Please fill Sorts Name.";
        } else if(!isset($array['joinCode']) || trim($array['joinCode']) == ''){
            echo "Please fill join Code.";
        // } else if(!isset($array['siteName']) || trim($array['siteName']) == ''){
        //     echo "Please select Site Name.";
        // } else if(!isset($array['sportsType']) || trim($array['sportsType']) == ''){
        //     echo "Please fill Sports Type.";
        } else if(!isset($array['sportsDesc']) || trim($array['sportsDesc']) == ''){
            echo "Please fill Bonus Description.";
        } else if(!isset($array['link']) || trim($array['link']) == ''){
            echo "Please fill Site URL.";
        } else if(!isset($array['maxPrizeMoney']) || trim($array['maxPrizeMoney']) == ''){
            echo "Please fill Max Prize Money.";
        } else if(!isset($array['singleBet']) || trim($array['singleBet']) == ''){
            echo "Please fill Single Bet Value.";
        } else if(!isset($array['crossBetting']) || trim($array['crossBetting']) == ''){
            echo "Please fill Cross Betting Value.";
        } else if(!isset($array['imageName']) || trim($array['imageName']) == ''){
            echo "Please fill Image Name.";
        } else if(!isset($array['categoryType']) || trim($array['categoryType']) == ''){
            echo "Please fill Category of Sports.";
        } else if(!isset($array['hotNew']) || trim($array['hotNew']) == ''){
            echo "Please fill HOT OR NEW.";
        } else if(!isset($array['welcomeBonus']) || trim($array['welcomeBonus']) == ''){
            echo "Please fill Welcome Bonus.";
        } else if(!isset($array['miniGame']) || trim($array['miniGame']) == ''){
            echo "Please fill Mini Game.";
        } else if(!isset($array['rate']) || trim($array['rate']) == ''){
            echo "Please rate.";
		} else if(!isset($array['sportsRevw']) || trim($array['sportsRevw']) == ''){
		echo "Please add review about the sports.";
        } else {

        if(isset($file) && is_array($file) && count($file) > 0 && (int)$file['sportsImage']['size'] > 0){
            $temp_name = $file['sportsImage']['tmp_name'];
            $get_ext = explode(".", strtolower($file['sportsImage']['name']));
            $the_file = $array['imageName'];
            $the_file = str_replace(' ', '_', $the_file) . "." . $get_ext[1];
            $directory = ROOT . "images";
            if(move_uploaded_file($temp_name, $directory . "/web/" . $the_file)){
                $the_message = "file uploaded successfully";
                $filePath = $directory . "/web/" . $the_file;
                chmod($filePath, 0777);
            }else{
                $the_error = $file['sportsImage']['error']; 
                $the_message = $upload_errors[$the_error];
            }
        }
        $detail = json_encode($array['addBonusDetailsLabel']) . '+' . json_encode($_POST['addBonusDetailsValue']);
        $sportsType = implode(",", $array['sportsType']);
        $sportsType = $sportsType . ',Sports';
        // Take action to create/edit
        $fieldArray = array(
            'sportsName' => trim($array['sportsName']),
            'joinCode' => trim($array['joinCode']),
            'siteName' => trim($array['sportsName']),
            'sportsType' => trim($sportsType),
            'description' => trim($array['sportsDesc']),
            'link' => trim($array['link']),
            'maxPrizeMoney' => trim($array['maxPrizeMoney']),
            'singleBet' => trim($array['singleBet']),
            'crossBetting' => trim($array['crossBetting']),
            'welcomeBonus' => trim($array['welcomeBonus']),
            'miniGame' => trim($array['miniGame']),
            'imageName' => trim($the_file),
            'isRecommanded' => trim($array['categoryType']),
            'isHot' => trim($array['hotNew']),
            'rating' => trim($array['rate']),
            'sportsReview' => trim($array['sportsRevw']),
            'sportsOtherDetails' => trim($detail),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
        );
            if(trim($filePath) != ''){
                $fieldArray['sportsImage'] = HOST . "images/web/" . $fieldArray['imageName'] ;
            }
            $update = false;
            if(!$update){ // Create new
                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                $this->query("INSERT INTO `tblWebCards` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
                echo "INSERT INTO `tblWebCards` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray);
            }  
        }
    }
    public function delwebCard($getId){
        if(isset($getId)){
            $this->query("DELETE FROM `tblWebCards` WHERE id = $getId");
        }
        return true;
    }

	public function updateWebCard($array){
        // Take action to create/edit
        $detail = json_encode($array['addBonusDetailsLabel']) . '+' . json_encode($_POST['addBonusDetailsValue']);
        $fieldArray = array(
            'sportsName' => trim($array['sportsName']),
            'joinCode' => trim($array['joinCode']),
            'siteName' => trim($array['sportsName']),
            //'sportsType' => trim($array['sportsType']),
            'description' => trim($array['sportsDesc']),
            'link' => trim($array['link']),
            'maxPrizeMoney' => trim($array['maxPrizeMoney']),
            'singleBet' => trim($array['singleBet']),
            'crossBetting' => trim($array['crossBetting']),
            'welcomeBonus' => trim($array['welcomeBonus']),
            'miniGame' => trim($array['miniGame']),
            'isRecommanded' => trim($array['categoryType']),
            'isHot' => trim($array['hotNew']),
            'rating' => trim($array['rate']),
            'sportsOtherDetails' => trim($detail),
            'sportsReview' => trim($array['sportsRevw']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
        );
            $update = false;
            if(!$update){ // Create new
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                $this->query("UPDATE `tblWebCards` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . $array['id'] . "'");
            } 
        return true;
    }
    /*Sadari CARD*/
    public function inserSadariCard($array, $file){
        if(!isset($array['sportsName']) || trim($array['sportsName']) == ''){
            echo "Please fill Sorts Name.";
        } else if(!isset($array['joinCode']) || trim($array['joinCode']) == ''){
            echo "Please fill join Code.";
        } else if(!isset($array['siteName']) || trim($array['siteName']) == ''){
            echo "Please select Site Name.";
        } else if(!isset($array['sportsType']) || trim($array['sportsType']) == ''){
            echo "Please fill Sports Type.";
        } else if(!isset($array['sportsDesc']) || trim($array['sportsDesc']) == ''){
            echo "Please fill Sports Description.";
        } else if(!isset($array['link']) || trim($array['link']) == ''){
            echo "Please fill Site URL.";
        } else if(!isset($array['wager']) || trim($array['wager']) == ''){
            echo "Please fill Wager.";
        } else if(!isset($array['maximumBetting']) || trim($array['maximumBetting']) == ''){
            echo "Please fill Maximum Betting.";
        } else if(!isset($array['ruMatin']) || trim($array['ruMatin']) == ''){
            echo "Please fill Rutin/Matin Value.";
        } else if(!isset($array['imageName']) || trim($array['imageName']) == ''){
            echo "Please fill Image Name.";
        } else if(!isset($array['categoryType']) || trim($array['categoryType']) == ''){
            echo "Please fill Category of Sports.";
        } else if(!isset($array['hotNew']) || trim($array['hotNew']) == ''){
            echo "Please fill HOT OR NEW.";
        } else if(!isset($array['sadariOdd']) || trim($array['sadariOdd']) == ''){
            echo "Please fill Welcome Bonus.";
        } else if(!isset($array['closingTime']) || trim($array['closingTime']) == ''){
            echo "Please fill Closing Time.";
        } else if(!isset($array['rate']) || trim($array['rate']) == ''){
            echo "Please rate.";
        } else if(!isset($array['sportsRevw']) || trim($array['sportsRevw']) == ''){
        echo "Please add review about the sports.";
        } else {

        if(isset($file) && is_array($file) && count($file) > 0 && (int)$file['sportsImage']['size'] > 0){
            $temp_name = $file['sportsImage']['tmp_name'];
            $get_ext = explode(".", strtolower($file['sportsImage']['name']));
            $the_file = $array['imageName'];
            $the_file = str_replace(' ', '_', $the_file) . "." . $get_ext[1];
            $directory = ROOT . "images";
            if(move_uploaded_file($temp_name, $directory . "/sadari/" . $the_file)){
                $the_message = "file uploaded successfully";
                $filePath = $directory . "/sadari/" . $the_file;
                chmod($filePath, 0777);
            }else{
                $the_error = $file['sportsImage']['error']; 
                $the_message = $upload_errors[$the_error];
            }
        }
        $detail = json_encode($array['addBonusDetailsLabel']) . '+' . json_encode($_POST['addBonusDetailsValue']);
        // Take action to create/edit
        $fieldArray = array(
            'sportsName' => trim($array['sportsName']),
            'joinCode' => trim($array['joinCode']),
            'siteName' => trim($array['siteName']),
            'sportsType' => trim($array['sportsType']),
            'description' => trim($array['sportsDesc']),
            'link' => trim($array['link']),
            'wager' => trim($array['wager']),
            'maximumBetting' => trim($array['maximumBetting']),
            'ruMatin' => trim($array['ruMatin']),
            'sadariOdd' => trim($array['sadariOdd']),
            'closingTime' => trim($array['closingTime']),
            'imageName' => trim($the_file),
            'isRecommanded' => trim($array['categoryType']),
            'isHot' => trim($array['hotNew']),
            'rating' => trim($array['rate']),
            'sportsOtherDetails' => trim($detail),
            'sportsReview' => trim($array['sportsRevw']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
        );
            if(trim($filePath) != ''){
                $fieldArray['sportsImage'] = HOST . "images/sadari/" . $fieldArray['imageName'] ;
            }
            $update = false;
            if(!$update){ // Create new
                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                $this->query("INSERT INTO `tblSadariCards` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
            }  
        }
    }
    public function delsadariCard($getId){
        if(isset($getId)){
            $this->query("DELETE FROM `tblSadariCards` WHERE id = $getId");
        }
        return true;
    }
    public function updateSadariCard($array){
        // Take action to create/edit
        $fieldArray = array(
            'sportsName' => trim($array['sportsName']),
            'joinCode' => trim($array['joinCode']),
            'siteName' => trim($array['siteName']),
            'description' => trim($array['sportsDesc']),
            'link' => trim($array['link']),
            'wager' => trim($array['wager']),
            'maximumBetting' => trim($array['maximumBetting']),
            'ruMatin' => trim($array['ruMatin']),
            'sadariOdd' => trim($array['sadariOdd']),
            'closingTime' => trim($array['closingTime']),
            'isRecommanded' => trim($array['categoryType']),
            'isHot' => trim($array['hotNew']),
            'rating' => trim($array['rate']),
            'sportsReview' => trim($array['sportsRevw']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
        );
            $update = false;
            if(!$update){ // Create new
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                $this->query("UPDATE `tblSadariCards` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . $array['id'] . "'");
            }
            return true;
        }
	
	
	
	/*Slider*/
    public function insertSlider($array, $file){
        if(!isset($array['sliderHeading']) || trim($array['sliderHeading']) == ''){
            $alert = "Please fill Slider Heading.";
        } else if(!isset($array['sliderText']) || trim($array['sliderText']) == ''){
            $alert = "Please fill slider Text.";
		} else if(!isset($array['sliderImageName']) || trim($array['sliderImageName']) == ''){
            $alert = "Please fill slider Image Name.";
        } else {

        if(isset($file) && is_array($file) && count($file) > 0 && (int)$file['sliderImage']['size'] > 0){
            $temp_name = $file['sliderImage']['tmp_name'];
            $get_ext = explode(".", strtolower($file['sliderImage']['name']));
            $the_file = $array['sliderImageName'];
            $the_file = str_replace(' ', '_', $the_file) . "." . $get_ext[1];
            $directory = ROOT . "images/slider";
            if(move_uploaded_file($temp_name, $directory . "/" . $the_file)){
                $the_message = "file uploaded successfully";
                $filePath = $directory . "/" . $the_file;
                chmod($filePath, 0777);
            }else{
                $the_error = $file['sliderImage']['error']; 
                $the_message = $upload_errors[$the_error];
            }
        }else{
            $alert = "Please add an Image to slider.";
        }
        $buttonOne = $array['buttonOneName'] . '+' . $array['buttonOneLink'] . '+' . $array['buttonOneColor'];
        $buttonTwo = $array['buttonTwoName'] . '+' . $array['buttonTwoLink'] . '+' . $array['buttonTwoColor'];
		
        // Take action to create/edit
        $fieldArray = array(
            'sliderHeading' => trim($array['sliderHeading']),
            'sliderText' => trim($array['sliderText']),
            'buttonOne' => trim($buttonOne),
            'buttonTwo' => trim($buttonTwo),
            'sliderImageName' => trim($the_file),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
        );
            if(trim($filePath) != ''){
                $fieldArray['sliderImage'] = HOST . "images/slider/" . $fieldArray['sliderImageName'] ;
            }
            $update = false;
            if(!$update){ // Create new
                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                $this->query("INSERT INTO `tblSlider` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
            }  
        }
        return true;
    }
    public function delSlider($getId){
        if(isset($getId)){
            $this->query("DELETE FROM `tblSlider` WHERE id = $getId");
        }
        return true;
    }

    public function updateSlider($array, $file){
        
        if(isset($file) && is_array($file) && count($file) > 0 && (int)$file['sliderImage']['size'] > 0){
            $temp_name = $file['sliderImage']['tmp_name'];
            $get_ext = explode(".", strtolower($file['sliderImage']['name']));
            $the_file = $array['sliderImageName'];
            $the_file = explode(".", $the_file);
            $the_file = $the_file[0] . "." . $get_ext[1];
            $directory = ROOT . "images/slider";
            if(move_uploaded_file($temp_name, $directory . "/" . $the_file)){
                $the_message = "file uploaded successfully";
                $filePath = $directory . "/" . $the_file;
                chmod($filePath, 0777);
            }else{
                $the_error = $file['sliderImage']['error']; 
                $the_message = $upload_errors[$the_error];
            }
        }else{
            $the_file = $array['sliderImageName'];;
        }
        // print_r($the_file);die();

        $buttonOne = $array['buttonOneName'] . '+' . $array['buttonOneLink'] . '+' . $array['buttonOneColor'];
        $buttonTwo = $array['buttonTwoName'] . '+' . $array['buttonTwoLink'] . '+' . $array['buttonTwoColor'];

        $fieldArray = array(
            'sliderHeading' => trim($array['sliderHeading']),
            'sliderText' => trim($array['sliderText']),
            'buttonOne' => trim($buttonOne),
            'buttonTwo' => trim($buttonTwo),
            'sliderImageName' => trim($the_file),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
        );
        if(trim($filePath) != ''){
            $fieldArray['sliderImage'] = HOST . "images/slider/" . $fieldArray['sliderImageName'] ;
        }
        $update = false;
        if(!$update){ // Create new
            $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
            $this->query("UPDATE `tblSlider` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . $array['id'] . "'");
        }
        return true;
    }

    /*NEWS BLOG*/
    public function inserNewsBlog($array, $file){
        if(!isset($array['Title']) || trim($array['Title']) == ''){
            echo "Please fill Title.";
        } else if(!isset($array['Author']) || trim($array['Author']) == ''){
            echo "Please fill Author Name.";
        } else if(!isset($array['newsDesc']) || trim($array['newsDesc']) == ''){
            echo "Please write few line in description.";
        } else if(!isset($array['newsImageName']) || trim($array['newsImageName']) == ''){
            echo "Please provide an image name.";
        } else if(!isset($array['newsType']) || trim($array['newsType']) == ''){
            echo "Please choose a Type.";
        } else {

        if(isset($file) && is_array($file) && count($file) > 0 && (int)$file['newsImage']['size'] > 0){
            $temp_name = $file['newsImage']['tmp_name'];
            $get_ext = explode(".", strtolower($file['newsImage']['name']));
            $the_file = $array['newsImageName'];
            $the_file = str_replace(' ', '_', $the_file) . "." . $get_ext[1];
            $directory = ROOT . "images/news";
            if(move_uploaded_file($temp_name, $directory . "/" . $the_file)){
                $the_message = "file uploaded successfully";
                $filePath = $directory . "/" . $the_file;
                chmod($filePath, 0777);
            }else{
                $the_error = $file['newsImage']['error']; 
                $the_message = $upload_errors[$the_error];
            }
        }
        
        // Take action to create/edit
        $fieldArray = array(
            'title' => trim($array['Title']),
            'author' => trim($array['Author']),
            'newsDesc' => trim($array['newsDesc']),
            'newsImageName' => trim($the_file),
            'isNews' => trim($array['newsType']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
        );
            if(trim($filePath) != ''){
                $fieldArray['newsImage'] = HOST . "images/news/" . $fieldArray['newsImageName'] ;
            }
            $update = false;
            if(!$update){ // Create new
                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                $this->query("INSERT INTO `tblNewsBlog` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
            }  
        }
    }

    public function updateNewsBlog($array){
         $fieldArray = array(
            'title' => trim($array['Title']),
            'author' => trim($array['Author']),
            'newsDesc' => trim($array['newsDesc']),
            'isNews' => trim($array['newsType']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
        );
         $update = false;
        if(!$update){ // Create new
            $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
            $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
            $this->query("UPDATE `tblNewsBlog` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . $array['id'] . "'");
        }
        return true;
    }


    public function addSportsComments($array, $id){
        if(!isset($id) || trim($id) == ''){
            Message::addMessage("PLEASE TRY AGAIN LATER.", ERR);
        } else if(!isset($array['checkPost']) || trim($array['checkPost']) == ''){
            Message::addMessage("Please Select the Terms and condition check box to post you comment.", ERR);
        } else {
        
        // Take action to create/edit
        $fieldArray = array(
            'sportsId' => (int)$id,
            'userId' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'gdComments' => trim($array['likeComment']),
            'badComments' => trim($array['dislikeComment']),
            'rating' => trim($array['commentRate']),
            //'isRecommanded' => trim($array['isConfirm']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
        );
            $update = false;
            if(!$update){ // Create new
                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                $this->query("INSERT INTO `tblSportsComment` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
            }  
        }
    }
    
    public function addSadariSportsComments($array, $id){
        if(!isset($id) || trim($id) == ''){
            Message::addMessage("PLEASE TRY AGAIN LATER", ERR);
        } else if(!isset($array['checkPost']) || trim($array['checkPost']) == ''){
            Message::addMessage("Please Select the Terms and condition check box to post you comment.", ERR);
        } else {
        
        // Take action to create/edit
        $fieldArray = array(
            'sportsId' => (int)$id,
            'userId' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'gdComments' => trim($array['likeComment']),
            'badComments' => trim($array['dislikeComment']),
            'rating' => trim($array['commentRate']),
            //'isRecommanded' => trim($array['isConfirm']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
        );
            $update = false;
            if(!$update){ // Create new
                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                $this->query("INSERT INTO `tblSadariSportsComment` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
            }  
        }
    }



    public function addBonusComments($array, $id){
        if(!isset($id) || trim($id) == ''){
            Message::addMessage("PLEASE TRY AGAIN LATER", ERR);
        } else if(!isset($array['checkPost']) || trim($array['checkPost']) == ''){
            Message::addMessage("Please Select the Terms and condition check box to post you comment.", ERR);
        } else {
        
        // Take action to create/edit
        $fieldArray = array(
            'bonusId' => (int)$id,
            'userId' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'gdComments' => trim($array['likeComment']),
            'badComments' => trim($array['dislikeComment']),
            'rating' => trim($array['commentRate']),
            //'isRecommanded' => trim($array['isConfirm']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
        );
            $update = false;
            if(!$update){ // Create new
                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                $this->query("INSERT INTO `tblBonusComment` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
            }  
        }
    }

    public function addNewsComments($array, $id){
        if(!isset($id) || trim($id) == ''){
            echo "PLEASE TRY AGAIN LATER.";
        } else if(!isset($array['checkPost']) || trim($array['checkPost']) == ''){
            echo "Please Select the Terms and condition check box to post you comment.";
        } else {
        
        // Take action to create/edit
        $fieldArray = array(
            'bonusId' => (int)$id,
            'userId' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'gdComments' => trim($array['likeComment']),
            'badComments' => trim($array['dislikeComment']),
            //'rating' => trim($array['rate']),
            //'isRecommanded' => trim($array['isConfirm']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
        );
            $update = false;
            if(!$update){ // Create new
                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                $this->query("INSERT INTO `tblNewsComment` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
            }  
        }
    }

    public function delsportsComment($id){
        if(isset($id)){
            $this->query("DELETE FROM `tblSportsComment` WHERE id = '" . $id . "'");
        }
        return true;
    }
    public function confirmSportsComment($id){
        if(isset($id)){
            $this->query("UPDATE `tblSportsComment` SET `isRecommanded` = 'Y' WHERE id = '" . $id . "'");
        }
        return true;
    }
    public function delSadarisportsComment($id){
        if(isset($id)){
            $this->query("DELETE FROM `tblSadariSportsComment` WHERE id = '" . $id . "'");
        }
        return true;
    }
    public function confirmSadariSportsComment($id){
        if(isset($id)){
            $this->query("UPDATE `tblSadariSportsComment` SET `isRecommanded` = 'Y' WHERE id = '" . $id . "'");
        }
        return true;
    }
    public function delbonusComment($id){
        if(isset($id)){
            $this->query("DELETE FROM `tblBonusComment` WHERE id = '" . $id . "'");
        }
        return true;
    }
    public function confirmbonusComment($id){
        if(isset($id)){
            $this->query("UPDATE `tblBonusComment` SET `isRecommanded` = 'Y' WHERE id = '" . $id . "'");
        }
        return true;
    }
    public function delnewsComment($id){
        if(isset($id)){
            $this->query("DELETE FROM `tblNewsComment` WHERE id = '" . $id . "'");
        }
        return true;
    }
    public function confirmnewsComment($id){
        if(isset($id)){
            $this->query("UPDATE `tblNewsComment` SET `isRecommanded` = 'Y' WHERE id = '" . $id . "'");
        }
        return true;
    }



    /*COMPLAINT SECTION*/
    
    public function addComplaint($array, $file){
        if(!isset($array['reason']) || trim($array['reason']) == ''){
            Message::addMessage("Please fill Reason.", ERR);
        } else if(!isset($array['complaintTitle']) || trim($array['complaintTitle']) == ''){
            Message::addMessage("Please provide a Title or your complaint.", ERR);
        } else if(!isset($array['link']) || trim($array['link']) == ''){
            Message::addMessage("Please choose a Website.", ERR);
        } else if(!isset($array['complaintText']) || trim($array['complaintText']) == ''){
            Message::addMessage("Please provide text.", ERR);
        } else if(!isset($array['onSiteAccountName']) || trim($array['onSiteAccountName']) == ''){
            Message::addMessage("Please provide an account Name used in sports site , Information will not be published.", ERR);
        } else if(!isset($array['onSiteEmail']) || trim($array['onSiteEmail']) == ''){
            Message::addMessage("Please provide an Email Name used in sports site , Information will not be published.", ERR);
        } else if(!isset($array['radioTerms']) || trim($array['radioTerms']) == ''){
            Message::addMessage("Please check the Terms and Conditions.", ERR);
        } else {

        if(isset($file) && is_array($file) && count($file) > 0 && (int)$file['complaintFiles']['size'] > 0){
            $temp_name = $file['complaintFiles']['tmp_name'];
            $the_file = $file['complaintFiles']['name'];
            $directory = ROOT . 'images/complaint';
            if(move_uploaded_file($temp_name, $directory . '/' . $the_file)){
                $the_message = "file uploaded successfully";
                $filePath = $directory . "/" . $the_file;
                chmod($filePath, 0777);
            }else{
                $the_error = $file['complaintFiles']['error']; 
                $the_message = $upload_errors[$the_error];
            }
        }
        
        // Take action to create/edit
        $fieldArray = array(
            'userId' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'siteName' => trim($array['siteName']),
            'link' => trim($array['link']),
            'reason' => trim($array['reason']),
            'complaintTitle' => trim($array['complaintTitle']),
            'complaintText' => trim($array['complaintText']),
            // 'complaintFiles' => trim($the_file),
            'amount' => trim($array['amount']),
            'onSiteAccountName' => trim($array['onSiteAccountName']),
            'onSiteEmail' => trim($array['onSiteEmail']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
        );
            if(trim($filePath) != ''){
                $fieldArray['complaintFiles'] = HOST . "images/complaint/" . $the_file ;
            }
            $update = false;
            if(!$update){ // Create new
                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                // echo "INSERT INTO `tblComplaints` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray);
                $this->query("INSERT INTO `tblComplaints` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
            }
            Message::addMessage("Your Complaint is posted successfully.It will display after verification!!!", SUCCS);
            return true;  
        }
    }
    public function complaintResponse($array, $file){
        if(!isset($array['responsText']) || trim($array['responsText']) == ''){
            Message::addMessage("Please response to the complaint.", ERR);
        } else if(!isset($array['complaintId']) || trim($array['complaintId']) == ''){
            Message::addMessage("Complaint is not found", ERR);
        } else {

            
            $logedInID = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
            $userInfo = $this->query("SELECT `userId`, `siteName`, `groupId` FROM `tblUser` WHERE `id` = '" . $logedInID ."' LIMIT 1");
           $fieldArray = array(
            'complaintId' => trim($array['complaintId']),
            'responsText' => trim($array['responsText']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
        ); 
           if(!isset($array['responsText']) || trim($array['responsText']) == ''){
                $fieldArray['userId'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
           }else{
                $fieldArray['userId'] = trim($array['userId']);
           }
           if($userInfo[0]['groupId'] == 2){
                $fieldArray['siteName'] = trim($userInfo[0]['siteName']);
           }else if($userInfo[0]['groupId'] == 3){
                $fieldArray['siteName'] = trim($userInfo[0]['userId']);
           }else{
                $fieldArray['siteName'] = 'Betting Time Admin';
           }
           $update = false;
            if(!$update){ // Create new
                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                $this->query("INSERT INTO `tblComplaintsResponse` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
            }
            Message::addMessage("Your Response is posted successfully.It will display after verification!!!", SUCCS);
            return true;
        }
    }
    public function addNotice($array){
        if(!isset($array['noticeTitle']) || trim($array['noticeTitle']) == ''){
            Message::addMessage("Please add Notice Title.", ERR);
        } else if(!isset($array['noticeText']) || trim($array['noticeText']) == ''){
            Message::addMessage("Please add Notice Text.", ERR);
        } else {
        
        // Take action to create/edit
        $fieldArray = array(
            'userId' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'noticeTitle' => trim($array['noticeTitle']),
            'noticeText' => trim($array['noticeText']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
        );
            $update = false;
            if(!$update){ // Create new
                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                $this->query("INSERT INTO `tblNotice` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
            }  
        }
    }

    public function pageContentSave($array){
        if(!isset($array['categoryPage']) || trim($array['categoryPage']) == ''){
            Message::addMessage("Please Select Page.", ERR);
        } else if(!isset($array['categoryTitle']) || trim($array['categoryTitle']) == ''){
            Message::addMessage("Please Add a Title for the page", ERR);
        } else if(!isset($array['categoryContent']) || trim($array['categoryContent']) == ''){
            Message::addMessage("Please Add some Content to the page", ERR);
        } else {

            $fieldArray = array(
                'categoryPage' => trim($array['categoryPage']),
                'categoryTitle' => trim($array['categoryTitle']),
                'categoryContent' => trim($array['categoryContent']),
                'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
                'updatedOn' => date('Y-m-d H:i:s'),
            );
                
                $update = false;
                if(!$update){ // Create new
                    $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                    $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                    $this->query("INSERT INTO `tblContent` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
                }  
            }
    }

    public function pageContentUpdate($array){
        $fieldArray = array(
            'categoryPage' => trim($array['categoryPage']),
            'categoryTitle' => trim($array['categoryTitle']),
            'categoryContent' => trim($array['categoryContent']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
        );
                
        $update = false;
        if(!$update){ // Create new
            $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
            $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
            $this->query("UPDATE `tblContent` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `categoryPage` = '" . $array['categoryPage'] . "'");
        }
        return true; 
    }




    public function userDataShow($array = array(), $showFile = true){
      $dir = (isset($array['dirPath']) && trim($array['dirPath']) != '' ? trim($array['dirPath']) : USER_ASSETS_PATH . $this->getLoggedInUserId() . '/' . USER_ASSETS_PATH_CV);
      $fileNameCV = (isset($array['dataFileName']) && trim($array['dataFileName']) != '' ? trim($array['dataFileName']) : '.ht.cv.json');
        $path = $dir . $fileNameCV;
      $data = File::getContent($path);
      if(trim($data) != '')
        $data = json_decode($data, true);
        if(isset($data) && is_array($data) && count($data) > 0 ){
          if($showFile){
            $fileDir = (isset($array['fileDirPath']) && trim($array['fileDirPath']) != '' ? trim($array['fileDirPath']) : USER_ASSETS_PATH . $this->getLoggedInUserId() . '/images/');
            $fileName = (isset($array['fileName']) && trim($array['fileName']) != '' ? trim($array['fileName']) : 'profile_image_' . $this->getLoggedInUserId());
            $profilrImagePath = $fileDir . $fileName;
            if(File::exists($profilrImagePath)){
              $data['inputAttachments'] = $profilrImagePath;
            }
          }
          return $data;
        }
      return false;
    }

    

  function __destruct(){
    parent::__destruct();
  }
}