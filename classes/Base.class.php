<?php
class Base {

	const MODE = DB_MODE; // Possible values MYSQLI, PDO
	private $MySQLi = false;
	private $PDO = false;
    private $lastInsertId = 0;
	private $resultFoundRows = false;

	function __contruct(){
		$this->open();
	}

    public function checkAndGetValue($array, $key){
        if(isset($array[$key]) && trim($array[$key]) != ''){
            return trim($array[$key]);
        }
        return NULL;
    }

	public function open($connetion = false){
		$dbHost = DB_HOST;
		$dbUser = DB_USER;
		$dbPass = DB_PASS;
		$dbName = DB_NAME;
		if($connetion && is_array($connetion) && count($connetion) >= 4){
			$dbHost = $connetion[0];
			$dbUser = $connetion[1];
			$dbPass = $connetion[2];
			$dbName = $connetion[3];
		} else if($connetion && is_string($connetion) && trim($connetion) != ""){
			$dbName = $connetion;
		}
		switch(self::MODE){
			case 'MYSQLI':
				return $this->MySQLi = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
			break;
			case 'PDO':
			default:
				return $this->PDO = new PDO($this->getMySQLDSN($dbHost, $dbName), $dbUser, $dbPass);
			break;
		}
	}

	private function getMySQLDSN($host, $dbName){
		return 'mysql:dbname=' . $dbName . ';host:' . $host;
	}

	public function close(){
		switch(self::MODE){
			case 'MYSQLI':
				if($this->MySQLi){
					$this->MySQLi->close();
					$this->MySQLi = false;
				}
			break;
			case 'PDO':
			default:
				$this->PDO = false;
			break;
		}
	}

    public function fetch_all($resulttype = MYSQLI_NUM){
        switch(self::MODE){
			case 'MYSQLI':
				if (method_exists('mysqli_result', 'fetch_all')) # Compatibility layer with PHP < 5.3
					$res = parent::fetch_all($resulttype);
				else
					for ($res = array(); $tmp = $this->fetch_array($resulttype);) $res[] = $tmp;
			break;
			case 'PDO':
			default:
				$this->PDO = false;
			break;
		}
        return $res;
    }

	public function query($query, $connetion = false, $cache = true){
		if(C::$DISPLAY == 'VIEW')
			$cache = true;
			$result = false;
		if(!is_array($result) || strpos($query, 'SELECT') !== 0 || !$cache){
			$this->resultFoundRows = false;
			$result = false;
			if($this->open($connetion)){
				switch(self::MODE){
					case 'MYSQLI':
						if($this->MySQLi){
							if($execute = $this->MySQLi->query($query)){
								if(is_object($execute) && isset($execute->num_rows) && $execute->num_rows > 0){
									//$result = $execute->fetch_all(MYSQLI_ASSOC);
									for ($result = array(); $tmp = $execute->fetch_array(MYSQLI_ASSOC);) $result[] = $tmp;
									$execute->free();
									if(strpos($query, 'SQL_CALC_FOUND_ROWS') !== 0){
										if($execute = $this->MySQLi->query('SELECT FOUND_ROWS() AS `FOUND_ROWS`')){
											if(is_object($execute) && isset($execute->num_rows) && $execute->num_rows > 0){
												for ($this->resultFoundRows = array(); $tmp = $execute->fetch_array(MYSQLI_ASSOC);) $this->resultFoundRows[] = $tmp;
												$this->resultFoundRows = $this->resultFoundRows[0]['FOUND_ROWS'];
												$execute->free();
											}
										}
									}
								} else {
									$this->lastInsertId = $this->MySQLi->insert_id;
									$result = true;
								}
							}
							$this->close();
						}
					break;
					case 'PDO':
					default:
						if($this->PDO){
							$stmt = $this->PDO->prepare($query);
							$stmt->execute();
							$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
							if(count($result) > 0){
								$result = $result;
								if(strpos($query, 'SQL_CALC_FOUND_ROWS') !== 0){
									$stmt = $this->PDO->prepare('SELECT FOUND_ROWS() AS `FOUND_ROWS`');
									$stmt->execute();
									$this->resultFoundRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
									if(count($this->resultFoundRows) > 0){
										$this->resultFoundRows = $this->resultFoundRows[0]['FOUND_ROWS'];
									}
								}
							} else if($stmt->rowCount() > 0) {
								$this->lastInsertId = $this->PDO->lastInsertId();
								$result = true;
							}
							$this->close();
						}
					break;
				}

			}
		}
		return $result;
	}

	public function getFoundRows(){
		return $this->resultFoundRows;
	}

	public function insert_id(){
        return $this->lastInsertId;
	}

	public function prepareFieldsForInsertOrUpdate($fields){
		$updateFields = array();
		if(is_array($fields) && count($fields) > 0){
			foreach($fields as $fieldName => $fieldValue){
				$updateFields[] = "`" . $fieldName . "` = '" . $fieldValue . "'";
			}
		}
		return implode(', ', $updateFields);
	}

	function __destruct(){
		$this->close();
	}
}
