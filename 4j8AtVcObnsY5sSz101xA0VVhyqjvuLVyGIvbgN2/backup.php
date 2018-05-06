<?php
require_once('../config.php');  

// Load Classes
C::loadClass('User');
C::loadClass('Card');
C::loadClass('CMS');
//Init User class
$Base = new Base();
$User = new User();
$CMS = new CMS();
$Common = new Common();

if(isset($_POST) && is_array($_POST) && count($_POST) > 0){
    if(!isset($_POST['bonusName']) || trim($_POST['bonusName']) == ''){
      echo "Please fill card Name.";
    } else if(!isset($_POST['joinCode']) || trim($_POST['joinCode']) == ''){
      echo "Please fill join Code.";
    } else if(!isset($_POST['siteName']) || trim($_POST['siteName']) == ''){
      echo "Please select Site Name.";
    } else if(!isset($_POST['bonusCode']) || trim($_POST['bonusCode']) == ''){
      echo "Please fill Bonus Code.";
    } else if(!isset($_POST['bonustype']) || trim($_POST['bonustype']) == ''){
  echo "Please fill Bonus Type.";
    } else if(!isset($_POST['bonusAmount']) || trim($_POST['bonusAmount']) == ''){
    echo "Please fill Bonus Amount.";
    } else if(!isset($_POST['bonusDesc']) || trim($_POST['bonusDesc']) == ''){
    echo "Please fill Bonus Description.";
    } else if(!isset($_POST['wageringRequirements']) || trim($_POST['wageringRequirements']) == ''){
    echo "Please fill Wagering Requirements.";
    } else if(!isset($_POST['link']) || trim($_POST['link']) == ''){
    echo "Please fill Site URL.";
    } else if(!isset($_POST['imageName']) || trim($_POST['imageName']) == ''){
    echo "Please fill Image Name.";
    } else if(!isset($_POST['categoryType']) || trim($_POST['categoryType']) == ''){
    echo "Please fill Category of Sports.";
    } else {

      if(isset($_FILES) && is_array($_FILES) && count($_FILES) > 0 && (int)$_FILES['bonusImage']['size'] > 0){
        $temp_name = $_FILES['bonusImage']['tmp_name'];
    $get_ext = explode(".", strtolower($_FILES['bonusImage']['name']));
    $the_file = $_POST['imageName'];
    $the_file = str_replace(' ', '_', $the_file) . "." . $get_ext[1];
    $directory = ROOT . "images";
    if(move_uploaded_file($temp_name, $directory . "/" . $the_file)){
      $the_message = "file uploaded successfully";
      $filePath = $directory . "/" . $the_file;
      chmod($filePath, 0777);
      //print_r($_FILES);

    }else{
      $the_error = $_FILES['bonusImage']['error']; 
      $the_message = $upload_errors[$the_error];

    }
    
      }
      // Take action to create/edit
      $fieldArray = array(
        'bonusName' => trim($_POST['bonusName']),
        'joinCode' => trim($_POST['joinCode']),
        'siteName' => trim($_POST['siteName']),
        'bonusCode' => trim($_POST['bonusCode']),
        'bonustype' => trim($_POST['bonustype']),
        'bonusAmount' => trim($_POST['bonusAmount']),
        'description' => trim($_POST['bonusDesc']),
        'wageringRequirements' => trim($_POST['wageringRequirements']),
        'link' => trim($_POST['link']),
        'imageName' => trim($the_file),
        'isPopular' => trim($_POST['categoryType']),
        //'rating' => trim($_POST['rating']),
        //'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
        'updatedOn' => date('Y-m-d H:i:s'),
      );
        if(trim($filePath) != ''){
      // $fieldArray['bonusImage'] = $filePath;
          $fieldArray['bonusImage'] = HOST . "images/" . $fieldArray['imageName'] ;
        }
      $update = false;
        if(isset($fieldArray['updatedOn']) > 0){ // Edit
            if($result = $Base->query("SELECT COUNT(*) AS `rows` FROM `tblBonusCards` WHERE `updatedOn` = '" . $fieldArray['updatedOn'] . "'")){
                if(is_array($result)&& count($result) > 0){
                  if(isset($result[0]['rows']) && $result[0]['rows'] > 0){
                    $Base->query("UPDATE `tblBonusCards` SET " . $Base->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `updatedOn` = '" . $fieldArray['updatedOn'] . "'");
                    //$this->joinCodeSetUsed($array['joinCodeId']);
                    $update = true;
                    return $fieldArray['updatedOn'];
                }
              }
            }
      }
      if(!$update){ // Create new
        //$fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
        $fieldArray['updatedOn'] = date('Y-m-d H:i:s');
        $Base->query("INSERT INTO `tblBonusCards` SET " . $Base->prepareFieldsForInsertOrUpdate($fieldArray));
        //$this->joinCodeSetUsed($array['joinCodeId']);
        return $fieldArray['updatedOn'];
      }
      
      
      
     // header('Location: index.php');
       // print_r($_POST['categoryType']);
      } 
}
?>