<?php
class CMS extends Base {

  public static $NAV_TPL_RIGHT_SIDE_PARENT = '<li><a href="{__LINK__}">{__MENU_NAME__}</a>|{__CHILD_SET__}</li>';
  public static $NAV_TPL_RIGHT_SIDE_CHILD = '</ br><li><a href="{__LINK__}">{__MENU_NAME__}</a></li>';

  public static $NAV_TPL_HEADER_PARENT = '<li class="dropdown">
                                            <a href="{__LINK__}" class="dropdown-toggle text-white" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{__MENU_NAME__}</a>
                                            <ul class="dropdown-menu ask-list">{__CHILD_SET__}</ul>
                                          </li>';
  public static $NAV_TPL_HEADER_CHILD = '<li><a href="{__LINK__}">{__MENU_NAME__}</a></li>';

  function __contruct(){
		parent::__contruct();
	}

  public static function CMSPageArray($ddl = false, $onlyParents = false, $childOfParent = false, $parentChildSet = false, $editDataId = false){
    $CMS = new CMS();
    $where = '';
    $orderBy = " ORDER BY `pageName` ASC";
    $array = array();
    if($onlyParents){
      $where.= ($where != '' ? " AND " : " WHERE ") . "`parentId` = '0'";
    }
    if((int)$childOfParent > 0 && !$onlyParents){
      $where.= ($where != '' ? " AND " : " WHERE ") . "`parentId` = '" . (int)$childOfParent . "'";
    }

    if((int)$editDataId > 0 && !$onlyParents && !$ddl){
      $where.= ($where != '' ? " AND " : " WHERE ") . "`id` = '" . (int)$editDataId . "'";
    }

    if($parentChildSet){
      $orderBy = " ORDER BY `id`, `parentId`, `pageName` ASC";
    }

    $result = $CMS->query("SELECT `id`, `parentId`, `pageName`, `menueTitle`, `metaTitle`, `metaDescription`, `metaKeyWords`, `content` FROM `tblCMSPage` " . $where . $orderBy);
    if($ddl){
      $array = array(
        array(
          0,
          'Parent Page'
        )
      );
      if(is_array($result)&& count($result) > 0){
          foreach($result as $index => $fieldValues){
              $array[] = array(
                  $fieldValues['id'],
                  $fieldValues['menueTitle'] . '(' . $fieldValues['pageName'] . ')'
              );
          }
      }
    } else if($parentChildSet && !$ddl){
      if(is_array($result)&& count($result) > 0){
          foreach($result as $index => $fieldValues){
            if((int)$fieldValues['parentId'] == 0){
              $array[$fieldValues['id']] = $fieldValues;
            } else {
              $array[$fieldValues['parentId']]['sub'][$fieldValues['id']] = $fieldValues;
            }
          }
      }
    } else if((int)$editDataId > 0 && !$onlyParents && !$ddl){
        $array = $result[0];
    } else {
      $array = $result;
    }
    //print_r($array);die();
    return $array;
  }

  public function CMSPageCreate($array){
    C::loadClass('User');
    if(isset($array) && is_array($array) && count($array) > 0){
      if(!isset($array['parentId']) || (int)$array['parentId'] < 0){
        Message::addMessage("Please select parent Page.");
      } else if(!isset($array['pageName']) || trim($array['pageName']) == ''){
        Message::addMessage("Please fill page name.");
      } else if(!isset($array['menueTitle']) || trim($array['menueTitle']) == ''){
        Message::addMessage("Please fill menue title.");
      } else if(!isset($array['metaTitle']) || trim($array['metaTitle']) == ''){
        Message::addMessage("Please fill meta title.");
      } else if(!isset($array['metaDescription']) || trim($array['metaDescription']) == ''){
        Message::addMessage("Please fill meta description.");
      } else if(!isset($array['metaKeyWords']) || trim($array['metaKeyWords']) == ''){
        Message::addMessage("Please fill meta keywords.");
      } else if(!isset($array['content']) || trim($array['content']) == ''){
        Message::addMessage("Please fill content.");
      } else {
        // Take action to create/edit
        $fieldArray = array(
          'parentId' => (int)$array['parentId'],
          'pageName' => trim($array['pageName']),
          'menueTitle' => trim($array['menueTitle']),
          'metaTitle' => trim($array['metaTitle']),
          'metaDescription' => trim($array['metaDescription']),
          'metaKeyWords' => trim($array['metaKeyWords']),
          'content' => trim($array['content']),
          'updatedBy' => ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0),
          'updatedOn' => date('Y-m-d H:i:s'),
        );
        $update = false;
        if(isset($array['id']) && (int)$array['id'] > 0){ // Edit
          if($result = $this->query("SELECT COUNT(*) AS `rows` FROM `tblCMSPage` WHERE `id` = '" . (int)$array['id'] . "'")){
            if(is_array($result)&& count($result) > 0){
              if(isset($result[0]['rows']) && $result[0]['rows'] > 0){
                $this->query("UPDATE `tblCMSPage` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . (int)$array['id'] . "'");
                $update = true;
                return (int)$array['id'];
              }
            }
          }
        }

        if(!$update){	// Create new
          $fieldArray['createdBy'] = ((int)User::loggedInUserId() > 0 ? User::loggedInUserId() : 0);
          $fieldArray['createdOn'] = date('Y-m-d H:i:s');
          $this->query("INSERT INTO `tblCMSPage` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
          return $this->insert_id();
        }

      }
    }
  }

  public static function navigationGenerate($type = 'RIGHT_NAV'){
    $pages = self::CMSPageArray(false, false, false, true);
    $returnSet = '';
    if(is_array($pages) && count($pages) > 0){
      foreach ($pages as $parentId => $parentPageDetails) {
        $tplParent = '';
        $childArray = array();
        switch ($type) {
          case 'RIGHT_NAV':
          default:
            $tplParent = self::$NAV_TPL_RIGHT_SIDE_PARENT;
          break;

          case 'HEADER':
            $tplParent = self::$NAV_TPL_HEADER_PARENT;
          break;
        }
        if(is_array($parentPageDetails['sub']) && count($parentPageDetails['sub']) > 0){
          foreach ($parentPageDetails['sub'] as $pageId => $pageDetails) {
            $tplChild = '';
            switch ($type) {
              case 'RIGHT_NAV':
              default:
                $tplChild = self::$NAV_TPL_RIGHT_SIDE_CHILD;
              break;

              case 'HEADER':
                $tplChild = self::$NAV_TPL_HEADER_CHILD;
              break;
            }
            $replaceArray = array(
              '{__MENU_NAME__}' => $pageDetails['menueTitle'],
              '{__LINK__}' => $pageDetails['pageName'] . '?' . $pageDetails['id'],
            );
            $childArray[] = str_replace(array_keys($replaceArray), array_values($replaceArray), $tplChild);
          }
        }
        $replaceArrayParent = array(
          '{__MENU_NAME__}' => $parentPageDetails['menueTitle'],
          '{__LINK__}' => $parentPageDetails['pageName'] . '?' . $parentPageDetails['id'],
          '{__CHILD_SET__}' => implode('', $childArray),
        );
        $returnSet.= str_replace(array_keys($replaceArrayParent), array_values($replaceArrayParent), $tplParent);
      }
    }
    return $returnSet;
  }

  function __destruct(){
    parent::__destruct();
  }

}
