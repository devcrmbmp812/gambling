<?php
class Location extends Base {

	public static $RECORD_COUNT_COUNTRY = 0;
	public static $RECORD_COUNT_STATE = 0;
	public static $RECORD_COUNT_CITY = 0;
	public static $RECORD_COUNT_ZIPCODE = 0;

	function __contruct(){
		parent::__contruct();
	}

	public function manageCountry($array){
		if(is_array($array) && count($array) > 0){
			if(!isset($array['tblCountries']['countryName']) || trim($array['tblCountries']['countryName']) == ''){
				Message::addMessage("Please fill countryName.");
			} else if(!isset($array['tblCountries']['countryCode2']) || trim($array['tblCountries']['countryCode2']) == ''){
				Message::addMessage("Please fill ISO2 Code.");
			} else if(!isset($array['tblCountries']['countryCodeNumeric']) || trim($array['tblCountries']['countryCodeNumeric']) == ''){
				Message::addMessage("Please fill Numeric Code.");
			} else {
				$countryId = (isset($array['tblCountries']['id']) && (int)$array['tblCountries']['id'] > 0 ? (int)$array['tblCountries']['id'] : 0);
				$dupliateId = $this->checkDuplicateCountry($array['tblCountries']['countryName'], $countryId);
				if((int)$dupliateId > 0){
					Message::addMessage("This Country already exists.");
					return $dupliateId;
				} else {
					$duplicateISO2 = $this->checkDuplicateCountryISO2(trim($array['tblCountries']['countryCode2']), $countryId);
					if(isset($duplicateISO2) && trim($duplicateISO2) != ''){
						Message::addMessage("This ISO2 Code already exists in Country :" . $duplicateISO2);
						return false;
					} else {
						if(isset($array['tblCountries']['countryCode3']) && trim($array['tblCountries']['countryCode3']) != ''){
							$duplicateISO3 = $this->checkDuplicateCountryISO3(trim($array['tblCountries']['countryCode3']), $countryId);
						}
						if(isset($duplicateISO3) && trim($duplicateISO3) != ''){
							Message::addMessage("This ISO3 Code already exists in Country :" . $duplicateISO3);
							return false;
						} else {
							$duplicateNumericCode = $this->checkDuplicateCountryNumericCode(trim($array['tblCountries']['countryCodeNumeric']), $countryId);
							if(isset($duplicateNumericCode) && trim($duplicateNumericCode) != ''){
								Message::addMessage("This Numeric Code already exists in Country :" . $duplicateNumericCode);
								return false;
							} else {
								$fieldArray = array(
									'id' => $countryId,
									'countryCode2' => trim($array['tblCountries']['countryCode2']),
									'countryCode3' => (isset($array['tblCountries']['countryCode3']) && trim($array['tblCountries']['countryCode3']) != '' ? trim($array['tblCountries']['countryCode3']) : ''),
									'countryName' => (isset($array['tblCountries']['countryName']) && trim($array['tblCountries']['countryName']) != '' ? trim($array['tblCountries']['countryName']) : ''),
									'countryCodeNumeric' => (isset($array['tblCountries']['countryCodeNumeric']) && trim($array['tblCountries']['countryCodeNumeric']) != '' ? trim($array['tblCountries']['countryCodeNumeric']) : ''),
								);
								//(isset($array['tblCountries']['countryCode2']) && trim($array['tblCountries']['countryCode2']) != '' ? trim($array['tblCountries']['countryCode2']) : substr(strtoupper(trim($array['tblCountries']['countryName'])), 0, 2)),
								if(isset($array['tblCountries']['id']) && (int)$array['tblCountries']['id'] > 0){ //Update Country
									$this->query("UPDATE `tblCountries` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray)) . " WHERE `id` = '" . (int)$array['tblCountries']['id'] . "'";
									Message::addMessage("Country Updated successfully." , SUCCS);
									return (int)$array['tblCountries']['id'];
								} else {	//Create Country
									if(!$dupliateId){
										$this->query("INSERT INTO `tblCountries` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
										Message::addMessage("Country Inserted successfully." , SUCCS);
										return $this->insert_id();
									}
									return $dupliateId;
								}
							}
						}
					}
				}
			}
		}
		return false;
	}

	public function checkDuplicateCountry($countryName, $id =false){
		if(isset($id) && (int)$id > 0){
			$result = $this->query("SELECT `id` FROM `tblCountries` WHERE `countryName` = '" . trim($countryName) . "' AND `id` NOT IN('" . $id . "')");
		} else {
			$result = $this->query("SELECT `id` FROM `tblCountries` WHERE `countryName` = '" . trim($countryName) . "'");
		}
		if(is_array($result) && count($result) > 0 && isset($result[0]['id']) && (int)$result[0]['id'] > 0){
			return (int)$result[0]['id'];
		}
		return false;
	}

	public function checkDuplicateCountryISO2($ISO2, $id =false){
		if(isset($ISO2) && trim($ISO2) != ''){
			if(isset($id) && (int)$id > 0){
				$result = $this->query("SELECT `id`, `countryName` FROM `tblCountries` WHERE `countryCode2` = '" . trim($ISO2) . "' AND `id` NOT IN('" . $id . "')");
			} else {
				$result = $this->query("SELECT `id`, `countryName` FROM `tblCountries` WHERE `countryCode2` = '" . trim($ISO2) . "'");
			}
			if(is_array($result) && count($result) > 0){
				return $result[0]['countryName'];
			}
		}
		return false;
	}

	public function checkDuplicateCountryISO3($ISO3, $id =false){
		if(isset($ISO3) && trim($ISO3) != ''){
			if(isset($id) && (int)$id > 0){
				$result = $this->query("SELECT `id`, `countryName` FROM `tblCountries` WHERE `countryCode3` = '" . trim($ISO2) . "' AND `id` NOT IN('" . $id . "')");
			} else {
				$result = $this->query("SELECT `id`, `countryName` FROM `tblCountries` WHERE `countryCode3` = '" . trim($ISO2) . "'");
			}
			if(is_array($result) && count($result) > 0){
				return $result[0]['countryName'];
			}
		}
		return false;
	}

	public function checkDuplicateCountryNumericCode($Numeric, $id =false){
		if(isset($Numeric) && (int)$Numeric > 0 ){
			if(isset($id) && (int)$id > 0){
				$result = $this->query("SELECT `id`, `countryName` FROM `tblCountries` WHERE `countryCodeNumeric` = '" . (int)$Numeric . "' AND `id` NOT IN('" . $id . "')");
			} else {
				$result = $this->query("SELECT `id`, `countryName` FROM `tblCountries` WHERE `countryCodeNumeric` = '" . (int)$Numeric . "'");
			}
			if(is_array($result) && count($result) > 0){
				return $result[0]['countryName'];
			}
		}
		return false;
	}

	public function editCountry($id){
		$set =array();
		$result = $this->query("SELECT `id`, `countryName`, `countryCode2`, `countryCode3`, `countryCodeNumeric` FROM `tblCountries` WHERE `id` = '" . $id . "' LIMIT 0,1");
		if(is_array($result) && count($result) > 0){
			$set['tblCountries']['id'] = $result[0]['id'];
			$set['tblCountries']['countryName'] = $result[0]['countryName'];
			$set['tblCountries']['countryCode2'] = $result[0]['countryCode2'];
			$set['tblCountries']['countryCode3'] = $result[0]['countryCode3'];
			$set['tblCountries']['countryCodeNumeric'] = $result[0]['countryCodeNumeric'];
		}
		return $set;
	}

	public function manageState($array){
		if(is_array($array) && count($array) > 0){
			if(!isset($array['tblState']['stateName']) || trim($array['tblState']['stateName']) == ''){
				Message::addMessage("Please fill State Name.");
			} else {
				$dupliateId = false;
				if(is_array($array) && count($array) > 0){
					$stateId = (isset($array['tblState']['id']) && (int)$array['tblState']['id'] > 0 ? (int)$array['tblState']['id'] : 0);
					$dupliateId = $this->checkDuplicateState($array['tblState']['stateName'], $array['tblState']['countryId']);
					if((int)$dupliateId <= 0){
						$fieldArray = array(
							'id' => $stateId,
							'stateName' => (isset($array['tblState']['stateName']) && trim($array['tblState']['stateName']) != '' ? trim($array['tblState']['stateName']) : ''),
							'updateOn' => date('Y-m-d H:i:s'),
							'isApproved' => (isset($array['tblState']['isApproved']) && trim($array['tblState']['isApproved']) != '' ? trim($array['tblState']['isApproved']) : 'Y'),
							'isActive' => (isset($array['tblState']['isActive']) && trim($array['tblState']['isActive']) != '' ? trim($array['tblState']['isActive']) : 'Y'),
							'isDelete' => (isset($array['tblState']['isDelete']) && trim($array['tblState']['isDelete']) != '' ? trim($array['tblState']['isDelete']) : 'N'),
							'countryId' => (isset($array['tblState']['countryId']) && trim($array['tblState']['countryId']) != '' ? trim($array['tblState']['countryId']) : 0),
						);
						if(isset($array['tblState']['id']) && (int)$array['tblState']['id'] > 0){ //Update State
							$this->query("UPDATE `tblState` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . (int)$array['tblState']['id'] . "'");
							Message::addMessage("State Updated successfully.", SUCCS);
							return (int)$array['tblState']['id'];
						} else {	//Create State
							$fieldArray['createdBy'] = User::loggedInUserId();
							$fieldArray['createdOn'] = date('Y-m-d H:i:s');
							$this->query("INSERT INTO `tblState` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
							Message::addMessage("State Inserted successfully.", SUCCS);
							return $this->insert_id();
						}
					} else {
						Message::addMessage("This State already exists.");
						return $dupliateId;
					}
				}
			}
		}
	}

	public function checkDuplicateState($stateName, $countryId, $id = false){
		if(isset($id) && (int)$id > 0){
			$result = $this->query("SELECT `id` FROM `tblState` WHERE `stateName` = '" . trim($stateName) . "' AND `countryId` = '" . (int)$countryId . "' AND `id` NOT IN('" . $id . "') LIMIT 0, 1");
		} else {
			$result = $this->query("SELECT `id` FROM `tblState` WHERE `stateName` = '" . trim($stateName) . "' AND `countryId` = '" . (int)$countryId . "' LIMIT 0, 1");
		}
		if(is_array($result) && count($result) > 0 && isset($result[0]['id']) && (int)$result[0]['id'] > 0){
			return (int)$result[0]['id'];
		}
		return false;
	}

	public function editState($id){
		$set =array();
		$result = $this->query("SELECT `id`, `stateName` FROM `tblState` WHERE `id` = '" . $id . "' LIMIT 0,1");
		if(is_array($result) && count($result) > 0){
			$set['tblState']['id'] = $result[0]['id'];
			$set['tblState']['stateName'] = $result[0]['stateName'];
		}
		return $set;
	}

	public function manageCity($array){
		if(is_array($array) && count($array) > 0){
			if(!isset($array['tblCity']['cityName']) || trim($array['tblCity']['cityName']) == ''){
				Message::addMessage("Please fill City Name.");
			} else {
				$dupliateId = false;
				$cityId = (isset($array['tblCity']['id']) && (int)$array['tblCity']['id'] > 0 ? (int)$array['tblCity']['id'] : 0);
				$dupliateId = $this->checkDuplicateCity($array['tblCity']['cityName'], $array['tblCity']['stateId'], $cityId);
				if((int)$dupliateId <= 0){
					$fieldArray = array(
						'id' => $cityId,
						'cityName' => (isset($array['tblCity']['cityName']) && trim($array['tblCity']['cityName']) != '' ? trim($array['tblCity']['cityName']) : ''),
						'isApproved' => (isset($array['tblCity']['isApproved']) && trim($array['tblCity']['isApproved']) != '' ? trim($array['tblCity']['isApproved']) : 'Y'),
						'isActive' => (isset($array['tblCity']['isActive']) && trim($array['tblCity']['isActive']) != '' ? trim($array['tblCity']['isActive']) : 'Y'),
						'isDelete' => (isset($array['tblCity']['isDelete']) && trim($array['tblCity']['isDelete']) != '' ? trim($array['tblCity']['isDelete']) : 'N'),
						'stateId' => (isset($array['tblCity']['stateId']) && trim($array['tblCity']['stateId']) != '' ? trim($array['tblCity']['stateId']) : 0),
					);

					if(isset($array['tblCity']['id']) && (int)$array['tblCity']['id'] > 0){ //Update Country
						$this->query("UPDATE `tblCity` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . (int)$array['tblCity']['id'] . "'");
						Message::addMessage("City Updated successfully.", SUCCS);
						return (int)$array['tblCity']['id'];
					} else {	//Create State
						$fieldArray['createdBy'] = User::loggedInUserId();
						$fieldArray['createdOn'] = date('Y-m-d H:i:s');
						$this->query("INSERT INTO `tblCity` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
						Message::addMessage("City Inserted successfully.", SUCCS);
						return $this->insert_id();
					}
				} else {
					Message::addMessage("City Already exists.");
					return $dupliateId;
				}
			}
		}
		return false;
	}

	public function checkDuplicateCity($cityName, $stateId, $id = false){
		if(isset($id) && (int)$id > 0){
			$result = $this->query("SELECT `id` FROM `tblCity` WHERE `cityName` = '" . trim($cityName) . "' AND `stateId` = '" . (int)$stateId . "' AND `id` NOT IN('" . $id . "') LIMIT 0, 1");
		} else {
			$result = $this->query("SELECT `id` FROM `tblCity` WHERE `cityName` = '" . trim($cityName) . "' AND `stateId` = '" . (int)$stateId . "' LIMIT 0, 1");
		}
		if(is_array($result) && count($result) > 0 && isset($result[0]['id']) && (int)$result[0]['id'] > 0){
			return (int)$result[0]['id'];
		}
		return false;
	}

	public function editCity($id){
		$set =array();
		$result = $this->query("SELECT `id`, `cityName` FROM `tblCity` WHERE `id` = '" . $id . "' LIMIT 0,1");
		if(is_array($result) && count($result) > 0){
			$set['tblCity']['id'] = $result[0]['id'];
			$set['tblCity']['cityName'] = $result[0]['cityName'];
		}
		return $set;
	}

	public function manageZipCode($array){
		$dupliateId = false;
		if(is_array($array) && count($array) > 0){
			if(!isset($array['tblZipCode']['zipcode']) || trim($array['tblZipCode']['zipcode']) == ''){
				Message::addMessage("Please fill ZipCode.");
			} else if(isset($array['tblZipCode']['zipcode']) && strlen($array['tblZipCode']['zipcode']) < 6){
				Message::addMessage("Please fill valid ZipCode.");
			} else {
				$zipcodeId = (isset($array['tblZipCode']['id']) && (int)$array['tblZipCode']['id'] > 0 ? (int)$array['tblZipCode']['id'] : 0);
				$dupliateId = $this->checkDuplicateZipCode(trim($array['tblZipCode']['zipcode']), $array['tblZipCode']['cityId'], $zipcodeId);
				if((int)$dupliateId <= 0){
					$fieldArray = array(
						'id' => $zipcodeId,
						'zipCode' => (isset($array['tblZipCode']['zipcode']) && trim($array['tblZipCode']['zipcode']) != '' ? trim($array['tblZipCode']['zipcode']) : ''),
						'createdBy' => User::loggedInUserId(),
						'createdOn' => date('Y-m-d H:i:s'),
						'isApproved' => (isset($array['tblZipCode']['isApproved']) && trim($array['tblZipCode']['isApproved']) != '' ? trim($array['tblZipCode']['isApproved']) : 'Y'),
						'isActive' => (isset($array['tblZipCode']['isActive']) && trim($array['tblZipCode']['isActive']) != '' ? trim($array['tblZipCode']['isActive']) : 'Y'),
						'isDelete' => (isset($array['tblZipCode']['isDelete']) && trim($array['tblZipCode']['isDelete']) != '' ? trim($array['tblZipCode']['isDelete']) : 'N'),
						'cityId' => (isset($array['tblZipCode']['cityId']) && trim($array['tblZipCode']['cityId']) != '' ? trim($array['tblZipCode']['cityId']) : 0),
					);
					if(isset($array['tblZipCode']['id']) && (int)$array['tblZipCode']['id'] > 0){ //Update Country
						$this->query("UPDATE `tblZipCode` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray) . " WHERE `id` = '" . (int)$array['tblZipCode']['id'] . "'");
						Message::addMessage("ZipCode Updated successfully.", SUCCS);
						return (int)$array['tblZipCode']['id'];
					} else {	//Create State
						$this->query("INSERT INTO `tblZipCode` SET " . $this->prepareFieldsForInsertOrUpdate($fieldArray));
						Message::addMessage("ZipCode Inserted successfully.", SUCCS);
						return $this->insert_id();
					}
				} else {
					Message::addMessage("ZipCode Already exists.");
					return $dupliateId;
				}
			}
		}
		return $dupliateId;
	}
	public function checkDuplicateZipCode($zipcode, $cityId, $id = false){
		if(isset($id) && (int)$id > 0){
			$result = $this->query("SELECT `id` FROM `tblZipCode` WHERE `zipCode` = '" . trim($zipcode) . "' AND `cityId` = '" . (int)$cityId . "' AND `id` NOT IN('" . $id . "') LIMIT 0, 1");
		} else {
			$result = $this->query("SELECT `id` FROM `tblZipCode` WHERE `zipCode` = '" . trim($zipcode) . "' AND `cityId` = '" . (int)$cityId . "' LIMIT 0, 1");
		}
		if(is_array($result) && count($result) > 0 && isset($result[0]['id']) && (int)$result[0]['id'] > 0){
			return (int)$result[0]['id'];
		}
		return false;
	}

	public function editZip($id){
		$set =array();
		$result = $this->query("SELECT `id`, `zipCode` FROM `tblZipCode` WHERE `id` = '" . $id . "' LIMIT 0,1");
		if(is_array($result) && count($result) > 0){
			$set['tblZipCode']['id'] = $result[0]['id'];
			$set['tblZipCode']['zipcode'] = $result[0]['zipCode'];
		}
		return $set;
	}

    public function countryDDLArray($pagination = false){
        $array = array();
				$where = '';
				# Pagination Settings
				$limit = false;
				if($pagination && is_array($pagination) && count($pagination) > 0){
					$start = (((int)$pagination[0] - 1) * (int)$pagination[1]);
					$limit = " LIMIT " . $start . ", " . (int)$pagination[1];

					// Pagination Filter
					$limitIds = $this->query("SELECT SQL_CALC_FOUND_ROWS DISTINCT(`id`) AS `limitIds` FROM `tblCountries` ORDER BY `countryName` ASC" . $limit);

					// Total Count
					$totalCounts = $this->getFoundRows();
					if($totalCounts && (int)$totalCounts > 0){
						self::$RECORD_COUNT_COUNTRY = (int)$totalCounts;
					}
					if(isset($limitIds[0]['limitIds'])){
						$where.= ($where != '' ? " AND " : " WHERE ") . " `id` IN (" . implode(',', array_column($limitIds, 'limitIds')) . ")";
					}
				}
				//echo "SELECT `id`, `countryName` FROM `tblCountries` " . $where . " ORDER BY `countryName` ASC";die();
        $result = $this->query("SELECT `id`, `countryName` FROM `tblCountries` " . $where . " ORDER BY `countryName` ASC");
        if(is_array($result)&& count($result) > 0){
            foreach($result as $index => $fieldValues){
                $array[] = array(
                    $fieldValues['id'],
                    $fieldValues['countryName']
                );
            }
        }
        return $array;
    }

    public function stateDDLArray($countryId, $pagination = false){
        $array = array();
				$where = '';
				# Pagination Settings
				$limit = false;
				if($pagination && is_array($pagination) && count($pagination) > 0){
					$start = (((int)$pagination[0] - 1) * (int)$pagination[1]);
					$limit = " LIMIT " . $start . ", " . (int)$pagination[1];

					// Pagination Filter
					$limitIds = $this->query("SELECT SQL_CALC_FOUND_ROWS DISTINCT(`id`) AS `limitIds` FROM `tblState` WHERE `countryId` = '" . $countryId . "' ORDER BY `stateName` ASC" . $limit);

					// Total Count
					$totalCounts = $this->getFoundRows();
					if($totalCounts && (int)$totalCounts > 0){
						self::$RECORD_COUNT_STATE = (int)$totalCounts;
					}
					if(isset($limitIds[0]['limitIds'])){
						$where.= "AND `id` IN (" . implode(',', array_column($limitIds, 'limitIds')) . ")";
					}
				}
        $result = $this->query("SELECT `id`, `stateName` FROM `tblState` WHERE `countryId` = '" . $countryId . "' " . $where . " ORDER BY `stateName` ASC");
        if(is_array($result)&& count($result) > 0){
            foreach($result as $index => $fieldValues){
                $array[] = array(
                    $fieldValues['id'],
                    $fieldValues['stateName']
                );
            }
        }
        return $array;
    }

    public function cityDDLArray($stateId, $pagination = false){
        $array = array();
				$where = '';
				# Pagination Settings
				$limit = false;
				if($pagination && is_array($pagination) && count($pagination) > 0){
					$start = (((int)$pagination[0] - 1) * (int)$pagination[1]);
					$limit = " LIMIT " . $start . ", " . (int)$pagination[1];

					// Pagination Filter
					$limitIds = $this->query("SELECT SQL_CALC_FOUND_ROWS DISTINCT(`id`) AS `limitIds` FROM `tblCity` WHERE `stateId` = '" . (int)$stateId . "' ORDER BY `cityName` ASC" . $limit);

					// Total Count
					$totalCounts = $this->getFoundRows();
					if($totalCounts && (int)$totalCounts > 0){
						self::$RECORD_COUNT_CITY = (int)$totalCounts;
					}
					if(isset($limitIds[0]['limitIds'])){
						$where.= "AND `id` IN (" . implode(',', array_column($limitIds, 'limitIds')) . ")";
					}
				}
        $result = $this->query("SELECT `id`, `cityName` FROM `tblCity` WHERE `stateId` = '" . (int)$stateId . "' " . $where . " ORDER BY `cityName` ASC");
        if(is_array($result)&& count($result) > 0){
            foreach($result as $index => $fieldValues){
                $array[] = array(
                    $fieldValues['id'],
                    $fieldValues['cityName']
                );
            }
        }
        return $array;
    }

    public function zipCodeDDLArray($cityId, $pagination = false){
        $array = array();
				$where = '';
				# Pagination Settings
				$limit = false;
				if($pagination && is_array($pagination) && count($pagination) > 0){
					$start = (((int)$pagination[0] - 1) * (int)$pagination[1]);
					$limit = " LIMIT " . $start . ", " . (int)$pagination[1];

					// Pagination Filter
					$limitIds = $this->query("SELECT SQL_CALC_FOUND_ROWS DISTINCT(`id`) AS `limitIds` FROM `tblZipCode` WHERE `cityId` = '" . (int)$cityId . "' ORDER BY `zipCode` ASC" . $limit);

					// Total Count
					$totalCounts = $this->getFoundRows();
					if($totalCounts && (int)$totalCounts > 0){
						self::$RECORD_COUNT_ZIPCODE = (int)$totalCounts;
					}
					if(isset($limitIds[0]['limitIds'])){
						$where.= "AND `id` IN (" . implode(',', array_column($limitIds, 'limitIds')) . ")";
					}
				}
				//echo "SELECT `id`, `zipCode` FROM `tblZipCode` WHERE `cityId` = '" . (int)$cityId . "' " . $where . " ORDER BY `zipCode` ASC";die();
        $result = $this->query("SELECT `id`, `zipCode` FROM `tblZipCode` WHERE `cityId` = '" . (int)$cityId . "' " . $where . " ORDER BY `zipCode` ASC");
        if(is_array($result)&& count($result) > 0){
            foreach($result as $index => $fieldValues){
                $array[] = array(
                    $fieldValues['id'],
                    $fieldValues['zipCode']
                );
            }
        }
        return $array;
    }

    public static function getCityName($cityId){
        $Location = new Location();
        $result = $Location->query("SELECT `cityName` FROM `tblCity` WHERE `id` = '" . (int)$cityId . "' LIMIT 0,1");
        if(isset($result) && is_array($result) && count($result) > 0){
            return $result[0]['cityName'];
        }
        return false;
    }

		public static function getLocationName($array = false, $type){
        $Location = new Location();
				$tableName = '';
				$fieldName = array();
				$where = '';
				if(trim($type) != ''){
					switch ($type) {
						case 'COUNTRY':
							$tableName = '`tblCountries`';
							$fieldName = array(
								'id',
								'countryName'
							);
							break;
						case 'STATE':
							$tableName = '`tblState`';
							$fieldName = array(
								'id',
								'stateName'
							);
							break;
						case 'CITY':
							$tableName = '`tblCity`';
							$fieldName = array(
								'id',
								'cityName'
							);
							break;
						case 'ZIP':
							$tableName = '`tblZipCode`';
							$fieldName = array(
								'id',
								'zipCode'
							);
							break;
						default:
							# code...
							break;
					}
				}
				if(isset($array) && is_array($array) && count($array) > 0){
					foreach ($array as $key => $value) {
						$where.= ($where != "" ? " AND " : " WHERE") . "`" . $key . "` = '" . $value . "'";
					}
				}
        $result = $Location->query("SELECT `" . implode("`, `" , $fieldName) . "` FROM " . $tableName . $where . " LIMIT 0,1");
        if(isset($result) && is_array($result) && count($result) > 0){
            return $result;
        }
        return false;
    }

    public static function getCityId($cityName){
        $Location = new Location();
        $result = $Location->query("SELECT `id` FROM `tblCity` WHERE `cityName` = '" . trim($cityName) . "' LIMIT 0,1");
        if(isset($result) && is_array($result) && count($result) > 0){
            return $result[0]['id'];
        }
        return false;
    }

	public static function locationAdd($array){
		if(isset($array) && is_array($array) && count($array) > 0){
			$Location = new Location();
			$countryId = 0;
			$stateId = 0;
			$cityId = 0;
			$zipId = 0;
			$returnArray = array();
			if(isset($array['countryName']) && (int)$array['countryName'] > 0){
				$countryId = (int)$array['countryName'];
			} else {
				$country = $Location->query("SELECT `id`, `countryName` FROM `tblCountries` WHERE `countryName` = '" . trim($array['countryName']) . "'");
				if(is_array($country) && count($country) > 0){
					$countryId = $country[0]['id'];
				}
			}
			if((int)$countryId >0){
				if(isset($array['stateName']) && (int)$array['stateName'] > 0){
					$stateId = (int)$array['stateName'];
				} else {
					$stateId = $Location->manageState(array(
						'tblState' => array(
							'stateName' => trim($array['stateName']),
							'countryId' => (int)$countryId
						)));
				}
				if((int)$stateId >0){
					if(isset($array['cityName']) && (int)$array['cityName'] > 0){
						$cityId = (int)$array['cityName'];
					} else {
						$cityId = $Location->manageCity(array(
							'tblCity' => array(
								'cityName' => trim($array['cityName']),
								'stateId' => (int)$stateId
							)));
					}
					if((int)$cityId >0){
						if(isset($array['zipName']) && trim($array['zipName']) != ''){
							$result = $Location->query("SELECT `id`, `zipCode` FROM `tblZipCode` WHERE `cityId` = '" . (int)$cityId . "' AND `zipCode` = '" . trim($array['zipName']) . "'");
							if(is_array($result) && count($result) > 0){
								$zipId = $result[0]['id'];
							} else {
								$zipCodeCheck = $Location->query("SELECT `id`, `zipCode` FROM `tblZipCode` WHERE `cityId` = '" . (int)$cityId . "' AND `id` = '" . trim($array['zipName']) . "'");
								if(is_array($zipCodeCheck) && count($zipCodeCheck) > 0){
									$zipId = $zipCodeCheck[0]['id'];
								} else {
									$zipId = $Location->manageZipCode(array(
										'tblZipCode' => array(
											'zipcode' => trim($array['zipName']),
											'cityId' => (int)$cityId
										)));
								}
							}
						}
					}
				}
				$returnArray['countryId'] = $countryId;
				$returnArray['stateId'] = $stateId;
				$returnArray['cityId'] = $cityId;
				$returnArray['zipcodeId'] = $zipId;
			}
			return $returnArray;
		}
	}

	function __destruct(){
		parent::__destruct();
	}
}
