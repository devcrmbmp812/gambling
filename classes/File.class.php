<?php
class File {

	public function __contruct(){
	}

	public static function upload($tempFile, $destination, $newName = false, $allowed = array('txt')){
		if(is_array($tempFile) && count($tempFile) > 0 && trim($tempFile['name']) != ''){
			if($ext = self::checkUploadExtPermission($tempFile['name'], $allowed)){
				if ($tempFile['error'] == UPLOAD_ERR_OK) {
					if(move_uploaded_file($tempFile['tmp_name'], ROOT . $destination . ($newName ? $newName : Common::uuid())  . '.' . $ext)){
						return $destination . ($newName ? $newName : Common::uuid())  . '.' . $ext;
					}
				}
			}
			return false;
		}
		return true;
	}

	public static function checkUploadExtPermission($name, $allowed = array('txt')){
		$ext = pathinfo($name, PATHINFO_EXTENSION);
		if(in_array($ext, $allowed)){
			return $ext;
		}
		return false;
	}

	public static function createDir($dir){
		if((!file_exists(ROOT . $dir) || !is_dir(ROOT . $dir)) && mkdir(ROOT . $dir, 0777, true)){
			return rtrim($dir, '/') . '/';
		}
		return rtrim($dir, '/') . '/';
	}

	public static function remove($file){
		if(trim($file) != '' && file_exists(ROOT . $file) && is_file(ROOT . $file))
			return unlink(ROOT . $file);
		return false;
	}

	public static function removeDir($dir){
		if(trim($dir) != ''){
			$files = array_diff(scandir(ROOT . $dir), array('.','..'));
			foreach ($files as $file) {
			  (file_exists(ROOT . $dir . $file) && is_dir(ROOT . $dir . $file)) ? self::removeDir($dir . $file. '/') : self::remove($dir . $file);
			}
			return rmdir(ROOT . $dir);
		}
		return false;
	}

	public static function create($filePath, $content){
		if(file_put_contents($filePath, $content, true)){
			return $filePath;
		}
		return false;
	}

	public static function getContent($filePath, $url = false, $curl = false){
		$content = false;
		if((file_exists($filePath) && is_file($filePath)) || $url){
			if($curl){
				$content = C::CURLget($filePath);
			} else {
				$content = file_get_contents($filePath, true);
			}
		} else if(!filter_var($filePath, FILTER_VALIDATE_URL) === false){
			if($curl){
				$content = C::CURLget($filePath);
			} else {
				$content = file_get_contents($filePath, true);
			}
		}
		return $content;
	}

	public static function exists($file, $addRoot = true){
		if($addRoot)
			$file = ROOT . $file;
		return (file_exists($file) && is_file($file));
	}

	public static function getDirContents($path){
		if(file_exists($path) && is_dir($path)){
			return array_filter(scandir($path), function($v) {
				return ($v != '.' &&  $v != '..');
			});
		} else if(file_exists(ROOT . $path) && is_dir(ROOT . $path)){
			return array_filter(scandir(ROOT . $path), function($v) {
				return ($v != '.' &&  $v != '..');
			});
		}
		return false;
	}

	public function __destruct(){
	}
}
