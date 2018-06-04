<?php

class Card extends Base {

  function __contruct(){

	parent::__contruct();

	}



    /*SPORTS CARD*/

    public function inserBonusCard($array, $file){

        if(!isset($array['bonusName']) || trim($array['bonusName']) == ''){
            Message::addMessage("Please fill card Name.", ERR);
        } else if(!isset($array['joinCode']) || trim($array['joinCode']) == ''){
            Message::addMessage("Please fill join Code.", ERR);
        } else if(!isset($array['sportsName']) || trim($array['sportsName']) == ''){
            Message::addMessage("Please select Sports Name.", ERR);
        //} else if(!isset($array['bonusCode']) || trim($array['bonusCode']) == ''){
        //    Message::addMessage("Please fill Bonus Code.", ERR);
        } else if(!isset($array['bonustype']) || trim($array['bonustype']) == ''){
            Message::addMessage("Please fill Bonus Type.", ERR);
        } else if(!isset($array['bonusAmount']) || trim($array['bonusAmount']) == ''){
            Message::addMessage("Please fill Bonus Amount.", ERR);
        } else if(!isset($array['bonusDesc']) || trim($array['bonusDesc']) == ''){
            Message::addMessage("Please fill Bonus Description.", ERR);
        } else if(!isset($array['wageringRequirements']) || trim($array['wageringRequirements']) == ''){
            Message::addMessage("Please fill Wager Sports.", ERR);
        } else if(!isset($array['wageringRequirementsMinigame']) || trim($array['wageringRequirementsMinigame']) == ''){
            Message::addMessage("Please fill Wager Mini Game.", ERR);
        } else if(!isset($array['link']) || trim($array['link']) == ''){
            Message::addMessage("Please fill Site URL.", ERR);
        } else if(!isset($array['imageName']) || trim($array['imageName']) == ''){
            Message::addMessage("Please fill Image Name.", ERR);
        // } else if(!isset($array['addBonusDetailsLabel']) || is_array($array['addBonusDetailsLabel']) == ''){
        //     Message::addMessage("Please fill atleast One Other Details.", ERR);
        // } else if(!isset($array['addBonusDetailsValue']) || is_array($array['addBonusDetailsValue']) == ''){
        //     Message::addMessage("Please fill atleast One Other Details.", ERR);
        } else if(!isset($array['categoryType']) || trim($array['categoryType']) == ''){
            Message::addMessage("Please fill Category of Sports.", ERR);
        } else if(!isset($array['rate']) || trim($array['rate']) == ''){
            Message::addMessage("Please rate.", ERR);
        } else {

    if($array['sportsImagesname'] == ''){
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

                //echo "Sorry, file already exists.";
                Message::addMessage("Sorry, file already exists.", ERR);

                $uploadOk = 0;

            }

            if($get_ext[1] != "jpg" && $get_ext[1] != "png" && $get_ext[1] != "jpeg" && $get_ext[1] != "gif" ) {

                //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                Message::addMessage("Sorry, only JPG, JPEG, PNG & GIF files are allowed.", ERR);

                $uploadOk = 0;

            }

            if ($uploadOk == 0) {

                //echo "Sorry, your file was not uploaded.";
                Message::addMessage("Sorry, your file was not uploaded.", ERR);

                //die();

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
    }else{
        $the_file = $array['imageName'];
    }

        //$detail = json_encode($array['addBonusDetailsLabel']) . '+' . json_encode($_POST['addBonusDetailsValue']);

        //$detail = '';

        //if(!is_null($array['addBonusDetailsLabel'])){ //echo 'hi';
            $detail = implode(',', $array['addBonusDetailsLabel']) . '+' . implode(',', $array['addBonusDetailsValue']);
        //}

       // (!empty($array['buttonOneName']) ? $array['buttonOneName'] : '')

        // Take action to create/edit

        $fieldArray = array(

            'bonusName' => trim($array['bonusName']),

            'joinCode' => trim($array['joinCode']),

            'sportsName' => trim($array['sportsName']),

            //'bonusCode' => trim($array['bonusCode']),

            'bonustype' => trim($array['bonustype']),

            'bonusAmount' => trim($array['bonusAmount']),

            'description' => trim($array['bonusDesc']),

            'wageringRequirements' => trim($array['wageringRequirements']),
            'wageringRequirementsMinigame' => trim($array['wageringRequirementsMinigame']),

            'link' => trim($array['link']),

            'imageName' => trim($the_file),

            'isPopular' => trim($array['categoryType']),

            'minDepositeAmpount' => (is_string($array['minDepositeAmpount']) != '' ? $array['minDepositeAmpount'] : ''),

            //'rollingCondition' => (is_string($array['rollingCondition']) != '' ? $array['rollingCondition'] : ''),

            'bonusConUtilization' => (is_string($array['bonusConUtilization']) != '' ? $array['bonusConUtilization'] : ''),

            'maxBonusAmount' => (is_string($array['maxBonusAmount']) != '' ? $array['maxBonusAmount'] : ''),

            'maxCashout' => (is_string($array['maxCashout']) != '' ? $array['maxCashout'] : ''),

            'bonusWithdrawlCondition' => (is_string($array['bonusWithdrawlCondition']) != '' ? $array['bonusWithdrawlCondition'] : ''),

            'bonusOtherDetails' => trim($detail),

            'metaTitle' => (is_string($array['metaTitle']) != '' ? $array['metaTitle'] : ''),

            'metaDesc' => (is_string($array['metaDesc']) != '' ? $array['metaDesc'] : ''),

            'metaKeyword' => (is_string($array['metaKeyword']) != '' ? $array['metaKeyword'] : ''),

            'rating' => trim($array['rate']),

            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),

            'createdOn' => date('Y-m-d H:i:s'),

        );

            if(trim(@$filePath) != ''){

                $fieldArray['bonusImage'] ="images/bonus/" . $fieldArray['imageName'] ;

            }else{
                $fieldArray['bonusImage'] = $array['sportsImagesname'];
            }


            // echo '<pre>';
            // print_r($fieldArray);die();
            // echo '<pre>';

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

    public function updateBonusCard($array, $file){

        if(isset($file) && is_array($file) && count($file) > 0 && (int)$file['bonusImageUpdate']['size'] > 0){

            $temp_name = $file['bonusImageUpdate']['tmp_name'];

            $get_ext = explode(".", strtolower($file['bonusImageUpdate']['name']));

            $the_file = $array['imageName'];

            //$the_file = str_replace(' ', '_', $the_file) . "." . $get_ext[1];

            $directory = ROOT . "images";

            if(move_uploaded_file($temp_name, $directory . "/bonus/" . $the_file)){

                $the_message = "file uploaded successfully";

                $filePath = $directory . "/bonus/" . $the_file;

                chmod($filePath, 0777);

            }else{

                $the_error = $file['bonusImageUpdate']['error']; 

                $the_message = $upload_errors[$the_error];

            }

        }else{

            $the_file = $array['imageName'];

        }



        $detail = implode(',', $array['addBonusDetailsLabel']) . '+' . implode(',', $array['addBonusDetailsValue']);

        $fieldArray = array(

            'bonusName' => trim($array['bonusName']),

            'joinCode' => trim($array['joinCode']),

            'sportsName' => trim($array['sportsName']),

            //'bonusCode' => trim($array['bonusCode']),

            'bonustype' => trim($array['bonustype']),

            'bonusAmount' => trim($array['bonusAmount']),

            'description' => trim($array['bonusDesc']),

            'wageringRequirements' => trim($array['wageringRequirements']),
            'wageringRequirementsMinigame' => trim($array['wageringRequirementsMinigame']),

            'link' => trim($array['link']),

            'imageName' => trim($the_file),

            'isPopular' => trim($array['categoryType']),

            'bonusOtherDetails' => trim($detail),

            'minDepositeAmpount' => (is_string($array['minDepositeAmpount']) != '' ? $array['minDepositeAmpount'] : ''),

            //'rollingCondition' => (is_string($array['rollingCondition']) != '' ? $array['rollingCondition'] : ''),

            'bonusConUtilization' => (is_string($array['bonusConUtilization']) != '' ? $array['bonusConUtilization'] : ''),

            'maxBonusAmount' => (is_string($array['maxBonusAmount']) != '' ? $array['maxBonusAmount'] : ''),

            'maxCashout' => (is_string($array['maxCashout']) != '' ? $array['maxCashout'] : ''),

            'bonusWithdrawlCondition' => (is_string($array['bonusWithdrawlCondition']) != '' ? $array['bonusWithdrawlCondition'] : ''),

            'metaTitle' => (is_string($array['metaTitle']) != '' ? $array['metaTitle'] : ''),

            'metaDesc' => (is_string($array['metaDesc']) != '' ? $array['metaDesc'] : ''),

            'metaKeyword' => (is_string($array['metaKeyword']) != '' ? $array['metaKeyword'] : ''),

            'rating' => trim($array['rate']),

            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),

            'updatedOn' => date('Y-m-d H:i:s'),

        );

        if(trim($filePath) != ''){

                $fieldArray['bonusImage'] = "images/bonus/" . $fieldArray['imageName'] ;

            }
            // echo '<pre>';
            // print_r($fieldArray);die();
            // echo '<pre>';

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

        } else if(!isset($array['sportsDesc']) || trim($array['sportsDesc']) == ''){

            echo "Please fill Bonus Description.";

        } else if(!isset($array['link']) || trim($array['link']) == ''){

            echo "Please fill Site URL.";

        } else if(!isset($array['maxPrizeMoney']) || trim($array['maxPrizeMoney']) == ''){

            echo "Please fill Max Prize Money.";

        } else if(!isset($array['singleBet']) || trim($array['singleBet']) == ''){

            echo "Please fill Single Bet Value.";

        //} else if(!isset($array['crossBetting']) || trim($array['crossBetting']) == ''){

        //    echo "Please fill Cross Betting Value.";

        } else if(!isset($array['imageName']) || trim($array['imageName']) == ''){

            echo "Please fill Image Name.";

        } else if(!isset($array['categoryType']) || trim($array['categoryType']) == ''){

            echo "Please fill Category of Sports.";

        } else if(!isset($array['hotNew']) || trim($array['hotNew']) == ''){

            echo "Please fill HOT OR NEW.";

        } else if(!isset($array['welcomeBonus']) || trim($array['welcomeBonus']) == ''){

            echo "Please fill Welcome Bonus.";

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

		 //$detail = array_combine($array['addBonusDetailsLabel'],$array['addBonusDetailsValue']);

        //$detail_se = serialize($detail);

        $detail_se = implode(',', $array['addBonusDetailsLabel']) . '+' . implode(',', $_POST['addBonusDetailsValue']);



        $miniGame = implode(",", $array['miniGame']);

        $bettingOption = implode(",", $array['bettingOption']);

        $sportsType = implode(",", $array['sportsType']);

        $sportsType = $sportsType . ',Sports';

        // Take action to create/edit

        $fieldArray = array(

            'sportsName' => (is_string($array['sportsName']) != '' ? $array['sportsName'] : ''),

            'joinCode' => (is_string($array['joinCode']) != '' ? $array['joinCode'] : ''),

            'siteName' => (is_string($array['sportsName']) != '' ? $array['sportsName'] : ''),

            'sportsType' => trim($sportsType),

            'description' => (is_string($array['sportsDesc']) != '' ? $array['sportsDesc'] : ''),

            'link' => (is_string($array['link']) != '' ? $array['link'] : ''),

            'maxPrizeMoney' => (is_string($array['maxPrizeMoney']) != '' ? $array['maxPrizeMoney'] : ''),

            'singleBet' => (is_string($array['singleBet']) != '' ? $array['singleBet'] : ''),

            //'crossBetting' => trim($array['crossBetting']),

            'welcomeBonus' => (is_string($array['welcomeBonus']) != '' ? $array['welcomeBonus'] : ''),

            'miniGame' => trim($miniGame),

            //'liveChatText' => trim($array['liveChatText']),

            'imageName' => trim($the_file),

            'isRecommanded' => (is_string($array['categoryType']) != '' ? $array['categoryType'] : ''),

            'isHot' => trim($array['hotNew']),

            'rating' => trim($array['rate']),

            'bettingOption' => trim($bettingOption),

            'dwMethods' => (is_string($array['dwMethods']) != '' ? $array['dwMethods'] : ''),

            'maxWithdrawlLimit' => (is_string($array['maxWithdrawlLimit']) != '' ? $array['maxWithdrawlLimit'] : ''),

            'maxBettingAmount' => (is_string($array['maxBettingAmount']) != '' ? $array['maxBettingAmount'] : 0),

            'minBettingAmount' => (is_string($array['minBettingAmount']) != '' ? $array['minBettingAmount'] : 0),

            'everytimeDepositeBonus' => (is_string($array['everytimeDepositeBonus']) != '' ? $array['everytimeDepositeBonus'] : ''),

            'dailyBonus' => (is_string($array['dailyBonus']) != '' ? $array['dailyBonus'] : ''),

            'rebateBonus' => (is_string($array['rebateBonus']) != '' ? $array['rebateBonus'] : ''),

            'rollingBonus' => (is_string($array['rollingBonus']) != '' ? $array['rollingBonus'] : ''),

            //'established' => (is_string($array['established']) != '' ? $array['established'] : ''),

            'liveChat' => (is_string($array['liveChat']) != '' ? $array['liveChat'] : ''),

            'metaTitle' => (is_string($array['metaTitle']) != '' ? $array['metaTitle'] : ''),

            'metaDesc' => (is_string($array['metaDesc']) != '' ? $array['metaDesc'] : ''),

            'metaKeyword' => (is_string($array['metaKeyword']) != '' ? $array['metaKeyword'] : ''),

            'sportsReview' => trim($array['sportsRevw']),

            'sportsOtherDetails' => $detail_se,

            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),

            'createdOn' => date('Y-m-d H:i:s'),

        );

            if(trim($filePath) != ''){

                $fieldArray['sportsImage'] = "images/web/" . $fieldArray['imageName'] ;

            }

            //print_r($fieldArray);die();

            $update = false;

            if(!$update){ // Create new

                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');

                $this->query("INSERT INTO `tblWebCards` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));

                //echo $this->insert_id();;

            }  

        }

    }

    public function delwebCard($getId){

        if(isset($getId)){

            $this->query("DELETE FROM `tblWebCards` WHERE id = $getId");

        }

        return true;

    }



	public function updateWebCard($array, $file){

        // Take action to create/edit





        if(isset($file) && is_array($file) && count($file) > 0 && (int)$file['sportsImageUpdate']['size'] > 0){

            $temp_name = $file['sportsImageUpdate']['tmp_name'];

            $get_ext = explode(".", strtolower($file['sportsImageUpdate']['name']));

            $the_file = $array['imageName'];

            //$the_file = str_replace(' ', '_', $the_file) . "." . $get_ext[1];

            $directory = ROOT . "images";

            if(move_uploaded_file($temp_name, $directory . "/web/" . $the_file)){

                $the_message = "file uploaded successfully";

                $filePath = $directory . "/web/" . $the_file;

                chmod($filePath, 0777);

                //echo $the_message;
                //echo $filePath;

            }else{

                $the_error = $file['sportsImageUpdate']['error']; 

                $the_message = $upload_errors[$the_error];

            }

        }else{

            $the_file = $array['imageName'];

        }



        //$detail = array_combine($array['addBonusDetailsLabel'],$array['addBonusDetailsValue']);

        //$detail_se = serialize($detail);
        $detail_se = implode(',', $array['addBonusDetailsLabel']) . '+' . implode(',', $_POST['addBonusDetailsValue']);

        $miniGame = implode(",", $array['miniGame']);

        $bettingOption = implode(",", $array['bettingOption']);

        $sportsType = implode(",", $array['sportsType']);

        $sportsType = $sportsType . ',Sports';

        $fieldArray = array(

            'sportsName' => (is_string($array['sportsName']) != '' ? $array['sportsName'] : ''),

            'joinCode' => (is_string($array['joinCode']) != '' ? $array['joinCode'] : ''),

            'siteName' => (is_string($array['sportsName']) != '' ? $array['sportsName'] : ''),

            'sportsType' => trim($sportsType),

            'description' => (is_string($array['sportsDesc']) != '' ? $array['sportsDesc'] : ''),

            'link' => (is_string($array['link']) != '' ? $array['link'] : ''),

            'maxPrizeMoney' => (is_string($array['maxPrizeMoney']) != '' ? $array['maxPrizeMoney'] : ''),

            'singleBet' => (is_string($array['singleBet']) != '' ? $array['singleBet'] : ''),

            //'crossBetting' => trim($array['crossBetting']),

            'welcomeBonus' => (is_string($array['welcomeBonus']) != '' ? $array['welcomeBonus'] : ''),

            'miniGame' => trim($miniGame),

			//'liveChatText' => trim($array['liveChatText']),

            'isRecommanded' => (is_string($array['categoryType']) != '' ? $array['categoryType'] : ''),

            'isHot' => (is_string($array['hotNew']) != '' ? $array['hotNew'] : ''),

            'rating' => (is_string($array['rate']) != '' ? $array['rate'] : ''),

            'sportsOtherDetails' => $detail_se,

            'imageName' => trim($the_file),

            'bettingOption' => trim($bettingOption),

            'dwMethods' => (is_string($array['dwMethods']) != '' ? $array['dwMethods'] : ''),

            'maxWithdrawlLimit' => (is_string($array['maxWithdrawlLimit']) != '' ? $array['maxWithdrawlLimit'] : ''),

            'maxBettingAmount' => (is_string($array['maxBettingAmount']) != '' ? $array['maxBettingAmount'] : 0),

            'minBettingAmount' => (is_string($array['minBettingAmount']) != '' ? $array['minBettingAmount'] : 0),

            'everytimeDepositeBonus' => (is_string($array['everytimeDepositeBonus']) != '' ? $array['everytimeDepositeBonus'] : ''),

            'dailyBonus' => (is_string($array['dailyBonus']) != '' ? $array['dailyBonus'] : ''),

            'rebateBonus' => (is_string($array['rebateBonus']) != '' ? $array['rebateBonus'] : ''),

            'rollingBonus' => (is_string($array['rollingBonus']) != '' ? $array['rollingBonus'] : ''),

            //'established' => (is_string($array['established']) != '' ? $array['established'] : ''),

            'liveChat' => (is_string($array['liveChat']) != '' ? $array['liveChat'] : ''),

            'metaTitle' => (is_string($array['metaTitle']) != '' ? $array['metaTitle'] : ''),

            'metaDesc' => (is_string($array['metaDesc']) != '' ? $array['metaDesc'] : ''),
            
            'metaKeyword' => (is_string($array['metaKeyword']) != '' ? $array['metaKeyword'] : ''),

            'sportsReview' => trim($array['sportsRevw']),

            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),

            'updatedOn' => date('Y-m-d H:i:s'),

        );

            if(trim($filePath) != ''){

                $fieldArray['sportsImage'] = "images/web/" . $fieldArray['imageName'] ;

            }



            $update = false;

            if(!$update){ // Create new

                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');

//echo "UPDATE `tblWebCards` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . $array['id'] . "'";die();

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



        $bettingOption = implode(",", $array['bettingOption']);

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

            'minBettingAmount' => (is_string($array['minBettingAmount']) != '' ? $array['minBettingAmount'] : ''),

            'bettingOption' => trim($bettingOption),

            'rollingCondition' => (is_string($array['rollingCondition']) != '' ? $array['rollingCondition'] : ''),

            'maxAwardAmount' => (is_string($array['maxAwardAmount']) != '' ? $array['maxAwardAmount'] : ''),

            'sportsReview' => trim($array['sportsRevw']),

            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),

            'updatedOn' => date('Y-m-d H:i:s'),

        );

            if(trim($filePath) != ''){

                $fieldArray['sportsImage'] = "images/sadari/" . $fieldArray['imageName'] ;

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

    public function updateSadariCard($array, $file){

        

        if(isset($file) && is_array($file) && count($file) > 0 && (int)$file['sportsImageUpdate']['size'] > 0){

            $temp_name = $file['sportsImageUpdate']['tmp_name'];

            $get_ext = explode(".", strtolower($file['sportsImageUpdate']['name']));

            $the_file = $array['imageName'];

            //$the_file = str_replace(' ', '_', $the_file) . "." . $get_ext[1];

            $directory = ROOT . "images";

            if(move_uploaded_file($temp_name, $directory . "/sadari/" . $the_file)){

                $the_message = "file uploaded successfully";

                $filePath = $directory . "/sadari/" . $the_file;

                chmod($filePath, 0777);

            }else{

                $the_error = $file['sportsImageUpdate']['error']; 

                $the_message = $upload_errors[$the_error];

            }

        }else{

            $the_file = $array['imageName'];

        }



        $detail = json_encode($array['addBonusDetailsLabel']) . '+' . json_encode($_POST['addBonusDetailsValue']);



        $bettingOption = implode(",", $array['bettingOption']);

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

            'imageName' => trim($the_file),

            'sportsOtherDetails' => trim($detail),

            'rating' => trim($array['rate']),

            'minBettingAmount' => (is_string($array['minBettingAmount']) != '' ? $array['minBettingAmount'] : ''),

            'bettingOption' => trim($bettingOption),

            'rollingCondition' => (is_string($array['rollingCondition']) != '' ? $array['rollingCondition'] : ''),

            'maxAwardAmount' => (is_string($array['maxAwardAmount']) != '' ? $array['maxAwardAmount'] : ''),

            'sportsReview' => trim($array['sportsRevw']),

            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),

            'updatedOn' => date('Y-m-d H:i:s'),

        );

            if(trim($filePath) != ''){

                $fieldArray['sportsImage'] = "images/sadari/" . $fieldArray['imageName'] ;

            }

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

            //$alert = "Please fill Slider Heading.";
            Message::addMessage("Please fill Slider Heading.", ERR);

        } else if(!isset($array['sliderText']) || trim($array['sliderText']) == ''){

            //$alert = "Please fill slider Text.";
            Message::addMessage("Please fill slider Text.", ERR);

        } else if(!isset($array['sliderImageName']) || trim($array['sliderImageName']) == ''){

            //$alert = "Please fill slider Image Name.";
            Message::addMessage("Please fill slider Image Name.", ERR);

        } else {



        if(isset($file) && is_array($file) && count($file) > 0 && (int)$file['sliderImage']['size'] > 0){

            $temp_name = $file['sliderImage']['tmp_name'];

            $get_ext = explode(".", strtolower($file['sliderImage']['name']));

            $the_file = $array['sliderImageName'];

            $the_file = str_replace(' ', '_', $the_file) . "." . $get_ext[1];

            $directory = ROOT . "images/slider";

            if(move_uploaded_file($temp_name, $directory . "/" . $the_file)){

                $the_message = "file uploaded successfully";
                Message::addMessage($the_message, ERR);
                $filePath = $directory . "/" . $the_file;

                chmod($filePath, 0777);

            }else{

                $the_error = $file['sliderImage']['error']; 

                $the_message = $upload_errors[$the_error];

            }

        }else{

            $alert = "Please add an Image to Slider.";
            Message::addMessage($alert, ERR);

        }



        if(isset($file) && is_array($file) && count($file) > 0 && (int)$file['sliderRespImage']['size'] > 0){

            $temp_name = $file['sliderRespImage']['tmp_name'];

            $get_ext = explode(".", strtolower($file['sliderRespImage']['name']));

            $the_file1 = $array['sliderImageName'];

            $the_file1 = str_replace(' ', '_', $the_file1) . "." . $get_ext[1];

            $directory1 = ROOT . "images/slider/responsive";

            if(move_uploaded_file($temp_name, $directory1 . "/" . $the_file1)){

                $the_message = "file uploaded successfully";
                Message::addMessage($the_message, SUCCS);

                $filePath1 = $directory1 . "/" . $the_file1;

                chmod($filePath1, 0777);

            }else{

                $the_error = $file['sliderRespImage']['error']; 

                $the_message = $upload_errors[$the_error];
                
                Message::addMessage($the_message, ERR);
            }

        }else{

            //$alert = "Please add an Responsive Image to Slider.";
            Message::addMessage("Please add an Responsive Image to Slider.", ERR);

        }



        //$buttonOne = $array['buttonOneName'] . '+' . $array['buttonOneLink'] . '+' . $array['buttonOneColor'];

        $buttonOne = (!empty($array['buttonOneName']) ? $array['buttonOneName'] : '') . '+' . (!empty($array['buttonOneLink']) ? $array['buttonOneLink'] : '') . '+' . (!empty($array['buttonOneColor']) ? $array['buttonOneColor'] : '');
        $buttonTwo = (!empty($array['buttonTwoName']) ? $array['buttonTwoName'] : '') . '+' . (!empty($array['buttonTwoLink']) ? $array['buttonTwoLink'] : '') . '+' . (!empty($array['buttonTwoColor']) ? $array['buttonTwoColor'] : '');

        

        // Take action to create/edit

        $fieldArray = array(

            'sliderHeading' => trim($array['sliderHeading']),

            'sliderText' => trim($array['sliderText']),

            'buttonOne' => trim($buttonOne),

            'buttonTwo' => trim($buttonTwo),

            'sliderImageName' => trim($the_file),

            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),

            'createdOn' => date('Y-m-d H:i:s'),

        );

            if(trim($filePath) != ''){

                $fieldArray['sliderImage'] = "images/slider/" . $fieldArray['sliderImageName'] ;

            }

            if(trim($filePath1) != ''){

                $fieldArray['sliderRespImage'] = "images/slider/responsive/" . $fieldArray['sliderImageName'] ;

            }

            $update = false;

            if(!$update){ // Create new

                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                //echo "INSERT INTO `tblSlider` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray);die();
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





         if(isset($file) && is_array($file) && count($file) > 0 && (int)$file['sliderRespImage']['size'] > 0){

            $temp_name = $file['sliderRespImage']['tmp_name'];

            $get_ext = explode(".", strtolower($file['sliderRespImage']['name']));

            $the_file1 = $array['sliderImageName'];

            $the_file1 = explode(".", $the_file1);

            $the_file1 = $the_file1[0] . "." . $get_ext[1];

            $directory1 = ROOT . "images/slider/responsive/";

            if(move_uploaded_file($temp_name, $directory1 . "/" . $the_file1)){

                $the_message = "file uploaded successfully";

                $filePath1 = $directory1 . "/" . $the_file1;

                chmod($filePath1, 0777);

            }else{

                $the_error = $file['sliderRespImage']['error']; 

                $the_message = $upload_errors[$the_error];

            }

        }else{

            $the_file1 = $array['sliderImageName'];;

        }

        // print_r($the_file);die();



        //$buttonOne = $array['buttonOneName'] . '+' . $array['buttonOneLink'] . '+' . $array['buttonOneColor'];

        //$buttonTwo = $array['buttonTwoName'] . '+' . $array['buttonTwoLink'] . '+' . $array['buttonTwoColor'];
        
        $buttonOne = (!empty($array['buttonOneName']) ? $array['buttonOneName'] : '') . '+' . (!empty($array['buttonOneLink']) ? $array['buttonOneLink'] : '') . '+' . (!empty($array['buttonOneColor']) ? $array['buttonOneColor'] : '');
        $buttonTwo = (!empty($array['buttonTwoName']) ? $array['buttonTwoName'] : '') . '+' . (!empty($array['buttonTwoLink']) ? $array['buttonTwoLink'] : '') . '+' . (!empty($array['buttonTwoColor']) ? $array['buttonTwoColor'] : '');



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

            $fieldArray['sliderImage'] = "images/slider/" . $fieldArray['sliderImageName'] ;

        }

        if(trim($filePath1) != ''){

            $fieldArray['sliderRespImage'] = "images/slider/responsive/" . $fieldArray['sliderImageName'] ;

        }

        $update = false;

        if(!$update){ // Create new

            $fieldArray['updatedOn'] = date('Y-m-d H:i:s');

            $this->query("UPDATE `tblSlider` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . $array['id'] . "'");

        }

        return true;

    }



    /*Slider*/

    public function insertAds($array, $file){

        if(!isset($array['adsLink']) || trim($array['adsLink']) == ''){

			Message::addMessage("Please fill link.", ERR);

        } else if(!isset($array['sliderImageName']) || trim($array['sliderImageName']) == ''){

			Message::addMessage("Please fill Addvert Image Name.", ERR);

        } else if(!isset($array['adsSequence']) || trim($array['adsSequence']) == ''){

            
			Message::addMessage("Please add sequence.", ERR);

        } else {

            //print_r($array);die();

        if(isset($file) && is_array($file) && count($file) > 0 && (int)$file['sliderImage']['size'] > 0){

            $temp_name = $file['sliderImage']['tmp_name'];

            $get_ext = explode(".", strtolower($file['sliderImage']['name']));

            $the_file = $array['sliderImageName'];

            $the_file = str_replace(' ', '_', $the_file) . "." . $get_ext[1];

            $directory = ROOT . "images/adds";

            if(move_uploaded_file($temp_name, $directory . "/" . $the_file)){

                $the_message = "file uploaded successfully";

                $filePath = $directory . "/" . $the_file;

                chmod($filePath, 0777);

            }else{

                $the_error = $file['sliderImage']['error']; 

                $the_message = $upload_errors[$the_error];

            }

        }else{

            //$alert = "Please add an Image to Addvert.";
			Message::addMessage("Please add an Image to Addvert.", ERR);

        }

        

        // Take action to create/edit

        $fieldArray = array(

            'adsLink' => trim($array['adsLink']),

            'imageName' => trim($the_file),

            'sequence' => trim($array['adsSequence']),

            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),

            'createdOn' => date('Y-m-d H:i:s'),

        );

            if(trim($filePath) != ''){

                $fieldArray['adsImage'] = "images/adds/" . $fieldArray['imageName'] ;

            }

            $update = false;

            if(!$update){ // Create new

                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                //echo "INSERT INTO `tblAds` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray);die();
                $this->query("INSERT INTO `tblAds` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));

            }  

        }

        return true;

    }

    public function deladds($getId){

        if(isset($getId)){

            $this->query("DELETE FROM `tblAds` WHERE id = $getId");

        }

        return true;

    }



    public function updateAds($array, $file){

        

        if(isset($file) && is_array($file) && count($file) > 0 && (int)$file['sliderImage']['size'] > 0){

            $temp_name = $file['sliderImage']['tmp_name'];

            $get_ext = explode(".", strtolower($file['sliderImage']['name']));

            $the_file = $array['sliderImageName'];

            $the_file = explode(".", $the_file);

            $the_file = $the_file[0] . "." . $get_ext[1];

            $directory = ROOT . "images/adds";

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

        



        $fieldArray = array(

            'adsLink' => trim($array['adsLink']),

            'imageName' => trim($the_file),

            'sequence' => trim($array['adsSequence']),

            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),

            'updatedOn' => date('Y-m-d H:i:s'),

        );

        if(trim($filePath) != ''){

            $fieldArray['adsImage'] = "images/adds/" . $fieldArray['imageName'] ;

        }

        $update = false;

        if(!$update){ // Create new

            $fieldArray['updatedOn'] = date('Y-m-d H:i:s');

            $this->query("UPDATE `tblAds` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . $array['id'] . "'");

        }

        return true;

    }



    /*NEWS BLOG*/

    public function inserNewsBlog($array, $file){

        if(!isset($array['Title']) || trim($array['Title']) == ''){
			Message::addMessage("Please fill Title.", ERR);
        } else if(!isset($array['Author']) || trim($array['Author']) == ''){
			Message::addMessage("Please fill Author Name.", ERR);
        } else if(!isset($array['newsDesc']) || trim($array['newsDesc']) == ''){
			Message::addMessage("Please write few line in description.", ERR);
        } else if(!isset($array['newsImageName']) || trim($array['newsImageName']) == ''){
			Message::addMessage("Please provide an image name.", ERR);
        } else if(!isset($array['newsType']) || trim($array['newsType']) == ''){
			Message::addMessage("Please choose a Type.", ERR);
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
            'metaTitle' => (is_string($array['metaTitle']) != '' ? $array['metaTitle'] : ''),
            'metaDesc' => (is_string($array['metaDesc']) != '' ? $array['metaDesc'] : ''),
            'metaKeyword' => (is_string($array['metaKeyword']) != '' ? $array['metaKeyword'] : ''),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'createdOn' => date('Y-m-d H:i:s'),
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



    public function updateNewsBlog($array, $file){

        if(isset($file) && is_array($file) && count($file) > 0 && (int)$file['newsImage']['size'] > 0){
            $temp_name = $file['newsImage']['tmp_name'];
            $get_ext = explode(".", strtolower($file['newsImage']['name']));
            $the_file = $array['newsImageName'];
            //$the_file = str_replace(' ', '_', $the_file) . "." . $get_ext[1];
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

        $fieldArray = array(

            'title' => trim($array['Title']),
            'author' => trim($array['Author']),
            'newsDesc' => trim($array['newsDesc']),
            'isNews' => trim($array['newsType']),
            'metaTitle' => (is_string($array['metaTitle']) != '' ? $array['metaTitle'] : ''),
            'metaDesc' => (is_string($array['metaDesc']) != '' ? $array['metaDesc'] : ''),
            'metaKeyword' => (is_string($array['metaKeyword']) != '' ? $array['metaKeyword'] : ''),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),

        );

        if(trim($filePath) != ''){
            $fieldArray['newsImage'] = HOST . "images/news/" . $the_file ;
        }

        //print_r($fieldArray);die();

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

            'createdOn' => date('Y-m-d H:i:s'),

        );

            $update = false;

            if(!$update){ // Create new

                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');

                $this->query("INSERT INTO `tblSportsComment` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));

            }

			//Message::addMessage("Your comment will be displayed after verify by admin.", SUCCS);

			return true;

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

			//Message::addMessage("Your comment will be displayed after verify by admin.", SUCCS);

			return true;

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

            'createdOn' => date('Y-m-d H:i:s'),

        );

            $update = false;

            if(!$update){ // Create new

                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');

                $this->query("INSERT INTO `tblBonusComment` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));

            }

			Message::addMessage("Your comment will be displayed after verify by admin.", SUCCS);

			return true;

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

            'newsId' => (int)$id,

            'userId' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),

            'gdComments' => trim($array['likeComment']),

            'badComments' => trim($array['dislikeComment']),

            'rating' => trim($array['commentRate']),

            //'isRecommanded' => trim($array['isConfirm']),

            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),

            'createdOn' => date('Y-m-d H:i:s'),

        );

            $update = false;

            if(!$update){ // Create new

                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');

                $this->query("INSERT INTO `tblNewsComment` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));

            }

            return true;  

        }

    }





// add comment response

    public function addComentRespons($array, $table){

        if(!isset($array['responseId']) || trim($array['responseId']) == ''){

            Message::addMessage("PLEASE TRY AGAIN LATER.", ERR);

        } else if(!isset($array['category']) || trim($array['category']) == ''){

            Message::addMessage("PLEASE TRY AGAIN LATER.", ERR);

        } else if(!isset($array['categoryId']) || trim($array['categoryId']) == ''){

            Message::addMessage("PLEASE TRY AGAIN LATER.", ERR);

        } else if(!isset($array['check']) || trim($array['check']) == ''){

            Message::addMessage("PLEASE TRY AGAIN LATER.", ERR);

        } else if(!isset($array['comment']) || trim($array['comment']) == ''){

            Message::addMessage("Please write some comment.", ERR);

        } else {



            if(isset($array['check']) && $array['check'] == 'checkAdmin'){

                $check = $array['check'];

                $isVerified = 'Y';

            }else{

                $check = $array['check'];

                $isVerified = 'N';

            }

        

        // Take action to create/edit

        $fieldArray = array(

            'responseId' => trim(($array['responseId'])),

            'userId' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),

            'comment' => trim($array['comment']),

            'category' => trim($array['category']),

            'categoryId' => trim($array['categoryId']),

            'isVerified' => trim($isVerified),

            $check => 'Y',

            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),

            'createdOn' => date('Y-m-d H:i:s'),

        );

            $update = false;

            if(!$update){ // Create new

                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');

                $this->query("INSERT INTO `tblCommentResponse` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));

            }

            //Message::addMessage("Your comment will be displayed after verify by admin.", SUCCS);

            return true;

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

            // image mime to be checked against

            $imagetype = array(image_type_to_mime_type(IMAGETYPE_GIF), image_type_to_mime_type(IMAGETYPE_JPEG),

                image_type_to_mime_type(IMAGETYPE_PNG), image_type_to_mime_type(IMAGETYPE_BMP));

         

            $error_msg = "";
            $run = 'true';
            $imageUploadERROR = FALSE;
            $FOLDER = "images/complaint/";
            $files = $file["complaintFiles"];
            $filePath = array();
            for ($i = 0; $i < count($files["name"]); $i++) {
                if ($files["name"][$i] <> "" && $files["error"][$i] == 0) {
                    // uploaded file is OK
                    if (in_array($files["type"][$i], $imagetype)) {

                        // get the extention of the file

                        $file_extention = @strtolower(@end(@explode(".", $files["name"][$i])));
                        // Setting an unique name for the file
                        $file_name = date("Ymd") . '_' . rand(10000, 990000) . '.' . $file_extention;
                        if (move_uploaded_file($files["tmp_name"][$i], $FOLDER . $file_name) === FALSE) {
                            //$error_msg = "Error while uploading the file";
                            Message::addMessage("Error while uploading the file", ERR);
                        } else {
                            //$error_msg = "File uploaded successfully with name: " . $file_name;

                           // Message::addMessage("File uploaded successfully with name: " . $file_name, SUCCS);
                                $filePath[$i] = $FOLDER.$file_name;
                        }
                    } else {
                        //$error_msg = "File is not a valid image type.";
                        Message::addMessage("File is not a valid image type.", ERR);
                        $run = 'false';
                    }
                }
                if ($imageUploadERROR) {

                    // if upload error break the loop and display the error
                    break;
                }
            }

         

            if ($imageUploadERROR === FALSE) {
                // Failed to upload file, you can write your code here
                //echo $error_msg;
                //Message::addMessage($error_msg, ERR);
            } else {
                // file is uploaded, you can write your code here
                 Message::addMessage("All file is uploaded successfully", SUCCS);
                 //die();
            }

        

        // Take action to create/edit
        if($run == 'true'){
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
            'createdOn' => date('Y-m-d H:i:s'),
        );

            if($filePath != ''){
                $filePath = json_encode($filePath);
                $fieldArray['complaintFiles'] = $filePath;
            }

            $update = false;
            if(!$update){ // Create new
                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                // echo "INSERT INTO `tblComplaints` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray);
                $this->query("INSERT INTO `tblComplaints` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));

            }
            return true; 
            } 
        }
    }

    public function complaintResponse($array, $file){

        if(!isset($array['responsText']) || trim($array['responsText']) == ''){

            Message::addMessage("Please response to the complaint.", ERR);

        } else if(!isset($array['complaintId']) || trim($array['complaintId']) == ''){

            Message::addMessage("Complaint is not found", ERR);

        } else {

            $imagetype = array(image_type_to_mime_type(IMAGETYPE_GIF), image_type_to_mime_type(IMAGETYPE_JPEG),

                image_type_to_mime_type(IMAGETYPE_PNG), image_type_to_mime_type(IMAGETYPE_BMP));

         

            $error_msg = "";

            $run = 'true';

            $imageUploadERROR = FALSE;

            $FOLDER = "images/complaint/";

            $files = $file["complaintFiles"];

            $filePath = array();

         

            for ($i = 0; $i < count($files["name"]); $i++) {

         

                if ($files["name"][$i] <> "" && $files["error"][$i] == 0) {

                    // uploaded file is OK

         

                    if (in_array($files["type"][$i], $imagetype)) {

                        // get the extention of the file

                        $file_extention = @strtolower(@end(@explode(".", $files["name"][$i])));

                        // Setting an unique name for the file

                        $file_name = date("Ymd") . '_' . rand(10000, 990000) . '.' . $file_extention;

         

                        if (move_uploaded_file($files["tmp_name"][$i], $FOLDER . $file_name) === FALSE) {

                            //$error_msg = "Error while uploading the file";

                            Message::addMessage("Error while uploading the file", ERR);

                        } else {

                            //$error_msg = "File uploaded successfully with name: " . $file_name;

                           // Message::addMessage("File uploaded successfully with name: " . $file_name, SUCCS);

                            

                                $filePath[$i] = $FOLDER.$file_name;

                        }

                    } else {

                        //$error_msg = "File is not a valid image type.";

                        Message::addMessage("File is not a valid image type.", ERR);

                        $run = 'false';

                    }

                }

         

                if ($imageUploadERROR) {

                    // if upload error break the loop and display the error

                    break;

                }

            }

         

            if ($imageUploadERROR === FALSE) {

                // Failed to upload file, you can write your code here

                //echo $error_msg;

                //Message::addMessage($error_msg, ERR);

            } else {

                // file is uploaded, you can write your code here

                 Message::addMessage("All file is uploaded successfully", SUCCS);

                 //die();

            }

        //if($run == 'true'){    

            $logedInID = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

            $userInfo = $this->query("SELECT `userId`, `siteName`, `groupId` FROM `tblUser` WHERE `id` = '" . $logedInID ."' LIMIT 1");

           $fieldArray = array(

            'complaintId' => trim($array['complaintId']),

            'responsText' => trim($array['responsText']),

            //'userId' => trim($array['id']),

            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),

        ); 

           if(!isset($array['responsText']) || trim($array['responsText']) == ''){

                $fieldArray['userId'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

           }else{

                $fieldArray['userId'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

           }

           if($userInfo[0]['groupId'] == 2){

                $fieldArray['siteName'] = trim($userInfo[0]['siteName']);

                $fieldArray['userId'] = $logedInID;

           }else if($userInfo[0]['groupId'] == 3){

                $fieldArray['siteName'] = '';

                $fieldArray['userId'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

           }else{

                $fieldArray['siteName'] = 'Admin';
                $fieldArray['userId'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

           }

            if($filePath != ''){

                $filePath = json_encode($filePath);

                $fieldArray['responsFiles'] = $filePath;

            }
            //print_r($fieldArray);
           $update = false;

            if(!$update){ // Create new

                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

                $fieldArray['createdOn'] = date('Y-m-d H:i:s');
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
            //echo "INSERT INTO `tblComplaintsResponse` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray);die();
                $this->query("INSERT INTO `tblComplaintsResponse` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));

            }

            Message::addMessage("Your Response is posted successfully.It will display after verification!!!", SUCCS);

            return true;

       // }

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
            'createdOn' => date('Y-m-d H:i:s'),

        );


            
                $update = false;

                if(!$update){ // Create new

                    $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

                    $fieldArray['updatedOn'] = date('Y-m-d H:i:s');

                   $this->query("INSERT INTO `tblNotice` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
                
            }

        }

    }

    public function updateNotice($array){

        

        

        // Take action to create/edit

        $fieldArray = array(

            'userId' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),

            'noticeTitle' => trim($array['noticeTitle']),

            'noticeText' => trim($array['noticeText']),

            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0)

        );


            
            $update = false;

            if(!$update){ // Create new

                $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);

                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
//echo "UPDATE `tblNotice` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id`= '" . $array['id'] . "'";die();
               $this->query("UPDATE `tblNotice` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id`= '" . $array['id'] . "'");
            return true;
        }

    }

    public function complaintContent($array){

        if(!isset($array['categoryComplaint']) || trim($array['categoryComplaint']) == ''){

            Message::addMessage("Please select category.", ERR);

        } else if(!isset($array['categoryComplaintContent']) || trim($array['categoryComplaintContent']) == ''){

            Message::addMessage("Please add Text to category.", ERR);

        } else {

        

        // Take action to create/edit

        $fieldArray = array(

            // 'userId' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'categoryComplaint' => trim($array['categoryComplaint']),
            'categoryComplaintContent' => trim($array['categoryComplaintContent'])
        );

//array['id'] = false;

        //echo $array['id'];die();
        $id = (!empty($array['id']) ? $array['id'] : '');

            if($id != ''){ // Create new
                // $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                $this->query("UPDATE `tblComplaintContent` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE id = '" . $id . "'");

                Message::addMessage("Complaint content updated successfully", SUCCS);
            } else {
                $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
                $this->query("INSERT INTO `tblComplaintContent` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));

                Message::addMessage("Complaint content inserted successfully", SUCCS);
            }
            //INSERT INTO `tblContent` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray)

        return true;

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
                'metaTitle' => trim($array['metaTitle']),
                'metaKeyword' => trim($array['metaKeyword']),
                'metaDesc' => trim($array['metaDesc']),

                'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),

                'createdOn' => date('Y-m-d H:i:s'),

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
            'metaTitle' => trim($array['metaTitle']),
            'metaKeyword' => trim($array['metaKeyword']),
            'metaDesc' => trim($array['metaDesc']),

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