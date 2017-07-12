<?php
namespace app;

class ExportTextFile {
	public $data;
	public $fileName;
	
	/**
	 * ส่งข้อมูลออกในรูปแบบของ Text File
	 *
	 * @param array $fields
	 * @return boolean contents of the output buffer
	 */
	public function Export($fields = array()) {
		if (!is_array($this->data))
			return;
			
		ob_start();
		$df = fopen("php://output", "wb");
		fwrite($df, ("\xff\xfe"));
		foreach ($this->data as $row) {
			$str = join("\t", $row)."\r\n";
			fwrite($df, iconv('UTF-8', 'UCS-2LE', $str));
		}
		fclose($df);

		return ob_get_clean();
	}
	
	
	/**
	 * เซ็ต header file ที่ต้องการใช้งาน
	 *
	 * @param string $fileName ชื่อ file ที่ต้องการสร้าง
	 * @param array $option => ['fileType'=> 'txt or csv']
	 */
	public function SetHeader($fileName = NULL, $option = NULL){
		$now = gmdate("D, d M Y H:i:s");
		$expires = gmdate("D, d M Y H:i:s", time()+(7 * 24 * 60 * 60));
		
		$fileType = '.txt'; // default file เป็น .txt
		if(isset($option['fileType'])){
			switch ($option['fileType']){
				case 'csv':
						$fileType = '.csv';
					break;
				case 'txt':
						$fileType = '.txt';
					break;
				case 'DAT':
						$fileType = '.DAT';
					break;
			}
		}
		if (empty($fileName))
			$fileName = "exporter" . date('Y-m-d') . $fileType;
		else
			$fileName .= $fileType;
		
		$this->fileName = $fileName;
		header("Expires: {$expires} GMT");
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");
		
		header("Content-type: text/plain");
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		
		// disposition / encoding on response body
		header("Content-Disposition: attachment;filename={$fileName}");
		header("Content-Transfer-Encoding: binary");
	}
}