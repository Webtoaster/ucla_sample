<?php
	
	namespace App\Helper;
	
	use App\Repository\UploadRepository;
	use PhpOffice\PhpSpreadsheet\Exception;
	use PhpOffice\PhpSpreadsheet\IOFactory;
	
	/**
	 * Class SpreadsheetParser
	 *
	 * @package App\Helper
	 */
	class SpreadsheetParser
	{
		
		
		/**
		 * @param                    $upload_id
		 * @param  UploadRepository  $uploadRepository
		 *
		 * @return array
		 * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
		 * @throws Exception
		 */
		public function parseSpreadsheetFile($upload_id, UploadRepository $uploadRepository):array
		{
			
			
			$upload        = $uploadRepository->find($upload_id);
			$inputFileName = $upload->getAbsoluteFilePath();
			$inputFileType = IOFactory::identify($inputFileName);
			// dump($inputFileType);
			
			$reader = IOFactory::createReader($inputFileType);
			
			$sheetName = 'Data';
			
			$reader->setLoadSheetsOnly($sheetName);
			$reader->setReadDataOnly(TRUE);
			
			$spreadsheet = $reader->load($inputFileName);
			$data        = $spreadsheet->getActiveSheet()->toArray(
				NULL,
				FALSE,
				FALSE,
				TRUE
			)
			;
			
			return $data;
		}
		
		
	}