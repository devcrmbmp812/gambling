<?php
class Debug {
	public static $dataSet = array();
	public static $duplicateCall = array();
	
	public static function start(){
		return microtime(true);
	}
	
	public static function stop(){
		return microtime(true);
	}
	
	public static function totalTime($startTime, $endTime){
		return ($endTime - $startTime);
	}
	
	public static function result(){
		$debugString = '';
		$debugTypesSetDetails = array();
		if(is_array(self::$dataSet) && count(self::$dataSet) > 0){
			foreach(self::$dataSet as $key => $value){
				$totalTime = self::totalTime($value['startTime'], $value['endTime']);
				$debugString.= chr(13) . chr(13) . (!$value['type'] ? 'PROCESS: ' : $value['type'] . ': ') . chr(13) . $value['data'] . chr(13) . 'Total Time: ' . $totalTime . ' Secs';
				$debugTypesSetDetails[$value['type']]['total'] = (isset($debugTypesSetDetails[$value['type']]['total']) ? $debugTypesSetDetails[$value['type']]['total'] + 1 : 1);
				$debugTypesSetDetails[$value['type']]['totalTime'] = (isset($debugTypesSetDetails[$value['type']]['totalTime']) ? $debugTypesSetDetails[$value['type']]['totalTime'] + $totalTime : 1);
			}
		}
		
		if(is_array(self::$duplicateCall) && count(self::$duplicateCall) > 0){
			foreach(self::$duplicateCall as $key => $value){
				if((int)$value['count'] > 1){
					$debugString.= chr(13) . chr(13) . (!$value['type'] ? 'DUPLICATE CALL: ' : 'DUPLICATE ' . $value['type'] . ' CALL: ') . chr(13) . 'DATA: ' . chr(13) . $value['data'] . chr(13) . 'COUNT: ' . $value['count'] . chr(13) . 'Total Time: ' . $value['time'] . ' Secs';
					$debugTypesSetDetails['DUPLICATE CALL: ' . $value['type']]['total'] = (isset($debugTypesSetDetails['DUPLICATE CALL: ' . $value['type']]['total']) ? $debugTypesSetDetails['DUPLICATE CALL: ' . $value['type']]['total'] + $value['count'] : $value['count']);
					$debugTypesSetDetails['DUPLICATE CALL: ' . $value['type']]['totalTime'] = (isset($debugTypesSetDetails['DUPLICATE CALL: ' . $value['type']]['totalTime']) ? $debugTypesSetDetails['DUPLICATE CALL: ' . $value['type']]['totalTime'] + $value['time'] : $value['time']);
					$debugTypesSetDetails['DUPLICATE CALL: ' . $value['type']]['totalCall'] = (isset($debugTypesSetDetails['DUPLICATE CALL: ' . $value['type']]['totalCall']) ? $debugTypesSetDetails['DUPLICATE CALL: ' . $value['type']]['totalCall'] + 1 : 1);
				}
			}
		}
		
		foreach($debugTypesSetDetails as $type => $details){
			$debugString.= chr(13) . chr(13) . 'Details For ' . $type . ':';
			$debugString.= chr(13) . 'Total Process: ' . $details['total'];
			$debugString.= chr(13) . 'Total Process Time: ' . $details['totalTime'];
			if(isset($details['totalCall']))
				$debugString.= chr(13) . 'Total No of Call: ' . $details['totalCall'];
		}
		return $debugString;
	}
	
	public static function addData($startTime, $endTime, $data, $type = false, $key = false, $cacheObj = false){
		$key = (!$key ? C::UUID() : $key);
		$trace = self::generateCallTrace();
		self::$dataSet[$key] = array(
			'startTime' => (!$startTime && isset($dataSet[$key]) ? $dataSet[$key] : $startTime),
			'endTime' => (!$endTime && isset($dataSet[$key]) ? $dataSet[$key] : $endTime),
			'data' => $data . chr(13) . $trace,
			'type' => $type
		);
		
		$rettr = array();
		if(isset(self::$duplicateCall[md5($data)])){
			$rettr[] = FSC::retrieve($cacheObj);
		}
		
		$count = (isset(self::$duplicateCall[md5($data)]) ? self::$duplicateCall[md5($data)]['count'] + 1 : 1);
		$totalTime = (isset(self::$duplicateCall[md5($data)]) ? self::$duplicateCall[md5($data)]['time'] : 0);
		$totalTime+= self::totalTime((!$startTime && isset($dataSet[$key]) ? $dataSet[$key] : $startTime), (!$endTime && isset($dataSet[$key]) ? $dataSet[$key] : $endTime));
		$duplicateData = (isset(self::$duplicateCall[md5($data)]) ? self::$duplicateCall[md5($data)]['data'] . chr(13) . chr(13) : '');
		$duplicateData.= $data . chr(13) . json_encode($cacheObj) . chr(13) . $trace . chr(13) . json_encode($rettr);
		self::$duplicateCall[md5($data)] = array(
			'time' => $totalTime,
			'count' => $count,
			'data' => $duplicateData,
			'type' => $type
		);
	}
	
	public static function generateCallTrace(){
		$e = new Exception();
		$trace = explode("\n", $e->getTraceAsString());
		// reverse array to make steps line up chronologically
		$trace = array_reverse($trace);
		array_shift($trace); // remove {main}
		array_pop($trace); // remove call to this method
		$length = count($trace);
		$result = array();

		for ($i = 0; $i < $length; $i++) {
			$result[] = ($i + 1)  . ')' . substr($trace[$i], strpos($trace[$i], ' ')); // replace '#someNum' with '$i)', set the right ordering
		}
		return "\t" . implode("\n\t", $result);
	}
}

class D extends Debug {
	
}