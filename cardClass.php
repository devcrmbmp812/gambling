<?php
class Cardclass {
  function __contruct(){
		parent::__contruct();
	}



	public function updateBonusCardImage($file, $id = fasle){
      $where = '';
      C::loadClass('File');
      if(is_array($file) && count($file) > 0){
        if((int)$id){
          $where.= ($where != '' ? " AND " : " WHERE ") . "`id` = '" . (int)$id . "'";
          $result = $this->query("SELECT `id`, `file` FROM `tblBonusCards` " . $where);
          if(is_array($result) && count($result) > 0){
            File::remove(BONUS_CARD_PATH . $result[0]['file']);
          }
        }
        $newName = C::uuid();
        $ext = pathinfo($file['image']['name'], PATHINFO_EXTENSION);
        if(File::upload($file['image'], BONUS_CARD_PATH, $newName, array('png', 'jpg', 'jpeg', 'gif'))){
          return $newName . '.' . $ext;
        }
      }
      return false;
    }

    public function bonusCardAdd($array, $file){
      C::loadClass('User');
      if(isset($array) && is_array($array) && count($array) > 0){
        if(!isset($array['bonusName']) || trim($array['bonusName']) == ''){
          Message::addMessage("Please fill card Name.");
        } else if(!isset($array['joinCode']) || trim($array['joinCode']) == ''){
          Message::addMessage("Please fill join Code.");
        } else if(!isset($array['siteName']) || trim($array['siteName']) == ''){
          Message::addMessage("Please select casable.");
        } else if(!isset($array['bonusCode']) || trim($array['bonusCode']) == ''){
          Message::addMessage("Please fill Bonus Code.");
        } else if(!isset($array['bonustype']) || trim($array['bonustype']) == ''){
        Message::addMessage("Please fill Bonus Type.");
        } else if(!isset($array['bonusAmount']) || trim($array['bonusAmount']) == ''){
        Message::addMessage("Please fill Bonus Amount.");
        } else if(!isset($array['bonusDesc']) || trim($array['bonusDesc']) == ''){
        Message::addMessage("Please fill Bonus Description.");
        } else if(!isset($array['wageringRequirements']) || trim($array['wageringRequirements']) == ''){
        Message::addMessage("Please fill Wagering Requirements.");
        } else if(!isset($array['link']) || trim($array['link']) == ''){
        Message::addMessage("Please fill Site URL.");
        } else if(!isset($array['imageName']) || trim($array['imageName']) == ''){
        Message::addMessage("Please fill Image Name.");
        } else if(!isset($array['categoryType']) || trim($array['categoryType']) == ''){
        Message::addMessage("Please fill Category of Sports.");
        } else {
          $id = false;
          $fileName = '';
          if(isset($array['id']) && (int)$array['id'] > 0){
            $id = (int)$array['id'];
          }
          if(is_array($file) && count($file) > 0 && (int)$file['image']['size'] > 0){
            $fileName = $this->updateBonusCardImage($file, $id);
          }
          // Take action to create/edit
          $fieldArray = array(
            'bonusName' => trim($array['bonusName']),
            'joinCode' => trim($array['joinCode']),
            'siteName' => trim($array['siteName']),
            'bonusCode' => trim($array['bonusCode']),
            'bonustype' => trim($array['bonustype']),
            'bonusAmount' => trim($array['bonusAmount']),
            'bonusDesc' => trim($array['bonusDesc']),
            'wageringRequirements' => trim($array['wageringRequirements']),
            'link' => trim($array['link']),
            'imageName' => trim($array['imageName']),
            'categoryType' => trim($array['categoryType']),
            //'rating' => trim($array['rating']),
            'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
            'updatedOn' => date('Y-m-d H:i:s'),
          );
          if(trim($fileName) != ''){
            $fieldArray['file'] = $fileName;
          }

	 function __destruct(){
    parent::__destruct();
  }
}