<?php
namespace lib;

class FileManager {
	//----------------------------------------------------------------------//
	//                              Свойства                                //
	//----------------------------------------------------------------------//
	public $rootPath;


	//----------------------------------------------------------------------//
	//                             Конструктор                              //
	//----------------------------------------------------------------------//
	public function __construct($rootPath = '') {
		$this->rootPath = $rootPath;
	}


	//----------------------------------------------------------------------//
	//                                Папки                                 //
	//----------------------------------------------------------------------//
	function scanDir ($path) {
		if (is_dir($path)) {
			$result = scandir($path);

			$files=array();$dirs=array();
			for ($x=0; $x<count($result); $x++) {
				// dir //
				if (is_dir($path . '/' . $result[$x]))
					$dirs[] = $result[$x];
				// file //
				else
					$files[] = ['name' => $result[$x], 'size' => filesize($path . '/' . $result[$x])];
			}

			$result = ['files' => $files, 'dirs' => $dirs];
			return $result;
		}
		else return "Error: Not dir.";
	}

	function makeDir ($path, $rights) {
		return mkdir($path, $rights);
	}

	function removeDir ($path) {
		rmdir($path);
	}
	function removeDirByShell ($path) {
		shell_exec("rm -r " . $path);
	}


	//----------------------------------------------------------------------//
	//                                Файлы                                 //
	//----------------------------------------------------------------------//
	function readFile ($path) {
		if (is_file($path))
			return file_get_contents($path, FILE_USE_INCLUDE_PATH);
		else
			return "Error. No file: " . $path;

	}
	function readFileByShell ($path, $options) {
		if (is_file($path))
			return shell_exec("cat " . $path . $options);
		else
			return "Error. No file: " . $path;
	}

	function writeFile ($path, $data) {
		file_put_contents($path, $data);

	}

	function removeFile ($path) {
		unlink($path);
	}
}
