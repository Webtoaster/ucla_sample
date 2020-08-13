<?php
	
	namespace App\Service;
	
	use Gedmo\Sluggable\Util\Urlizer;
	use RuntimeException;
	use Symfony\Component\HttpFoundation\File\UploadedFile;
	
	/**
	 * Class UploaderHelper
	 *
	 * @package App\Service
	 */
	class UploaderHelper
	{
		
		
		private $association_id;
		
		private $destination;
		
		private $uploadPath;
		
		
		/**
		 * UploaderHelper constructor.
		 *
		 * @param  string  $uploadPath
		 */
		public function __construct(string $uploadPath)
		{
			$this->uploadPath = $uploadPath;
		}
		
		
		/**
		 * @return bool
		 */
		private function checkAndMakeDirectory():bool
		{
			$this->destination = $this->uploadPath . DIRECTORY_SEPARATOR . $this->association_id . DIRECTORY_SEPARATOR;
			
			//            dump($this->destination);
			
			if(!is_dir($this->destination)){
				//Directory does not exist, so lets create it.
				if(!mkdir($this->destination, 0755, TRUE) && !is_dir($this->destination)){
					throw new RuntimeException(sprintf('Directory "%s" was not created', $this->destination));
				}
				
				//                dump($this->destination);
				
				return FALSE;
			}
			
			// $this->destination .= '/';
			
			//             dd($this->destination);
			
			return TRUE;
		}
		
		
		/**
		 * @param  UploadedFile  $uploadedFile
		 * @param  int           $association_id
		 *
		 * @return array
		 */
		public function uploadDataFile(UploadedFile $uploadedFile, int $association_id):array
		{
			$this->association_id = $association_id;
			
			$this->checkAndMakeDirectory();
			
			//  dd($this->destination);
			
			//  Give me a means of serializing the file names.
			$date = date('Y-m-d_H-i-s');
			
			$ra['mimeType']                 = $uploadedFile->getClientMimeType();
			$ra['originalUploadedFileName'] = $uploadedFile->getClientOriginalName();
			$ra['guessedFileExtension']     = $uploadedFile->guessExtension();
			//  $ra['newFileName'] = $ra['originalFileName'] . '.' . $ra['guessedFileExtension'];
			
			//  This is just the file name without an extension.
			$originalFileName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
			
			// Be sure to use the guessExtension method and not the guessClientExtension method
			// because the latter can't be trusted.
			$ra['newFileName'] = Urlizer::urlize($originalFileName) . '-' . $date . '.' . $uploadedFile->guessExtension();
			
			$ra['newAbsoluteFilePath'] = $this->destination . $ra['newFileName'];
			$ra['newWebPath']          =
				$_ENV['UPLOADED_FILE_PATH'] . DIRECTORY_SEPARATOR . $association_id . DIRECTORY_SEPARATOR . $ra['newFileName'];
			
			$uploadedFile->move(
				$this->destination,
				$ra['newFileName']
			);
			
			return $ra;
		}
		
		
		private function checkFileType()
		{
			/** @var UploadedFile $uploadedFile */
			//  $uploadedFile = $form['dataFile']->getData();
			
			//    $guessedFileExtension = $uploadedFile->guessExtension();
			
			$allowedFileTypes = [
				'xls',
				'xlsx',
				'csv',
			];
			
			// if (in_array($guessedFileExtension, $allowedFileTypes, TRUE) === FALSE) {
			//     dd($uploadedFile->guessExtension());
			// }
		}
		
		
		
		
		//
		// public function uploadArticleImage(File $file, ?string $existingFilename):string
		// {
		//     $newFilename = $this->uploadFile($file, self::ARTICLE_IMAGE, TRUE);
		//
		//     if ($existingFilename) {
		//         try {
		//             $result = $this->filesystem->delete(self::ARTICLE_IMAGE.'/'.$existingFilename);
		//
		//             if ($result === FALSE) {
		//                 throw new \Exception(sprintf('Could not delete old uploaded file "%s"', $existingFilename));
		//             }
		//         } catch (FileNotFoundException $e) {
		//             $this->logger->alert(sprintf('Old uploaded file "%s" was missing when trying to delete', $existingFilename));
		//         }
		//     }
		//
		//     return $newFilename;
		// }
		//
		// public function uploadArticleReference(File $file):string
		// {
		//     return $this->uploadFile($file, self::ARTICLE_REFERENCE, FALSE);
		// }
		//
		// public function getPublicPath(string $path):string
		// {
		//     $fullPath = $this->publicAssetBaseUrl.'/'.$path;
		//     // if it's already absolute, just return
		//     if (strpos($fullPath, '://') !== FALSE) {
		//         return $fullPath;
		//     }
		//
		//     // needed if you deploy under a subdirectory
		//     return $this->requestStackContext
		//             ->getBasePath().$fullPath;
		// }
		//
		// /**
		//  * @return resource
		//  */
		// public function readStream(string $path)
		// {
		//     $resource = $this->filesystem->readStream($path);
		//
		//     if ($resource === FALSE) {
		//         throw new \Exception(sprintf('Error opening stream for "%s"', $path));
		//     }
		//
		//     return $resource;
		// }
		//
		// public function deleteFile(string $path)
		// {
		//     $result = $this->filesystem->delete($path);
		//
		//     if ($result === FALSE) {
		//         throw new \Exception(sprintf('Error deleting "%s"', $path));
		//     }
		// }
		//
		// private function uploadFile(File $file, string $directory, bool $isPublic):string
		// {
		//     if ($file instanceof UploadedFile) {
		//         $originalFilename = $file->getClientOriginalName();
		//     } else {
		//         $originalFilename = $file->getFilename();
		//     }
		//     $newFilename = Urlizer::urlize(pathinfo($originalFilename, PATHINFO_FILENAME)).'-'.uniqid().'.'.$file->guessExtension();
		//
		//     $stream = fopen($file->getPathname(), 'r');
		//     $result = $this->filesystem->writeStream(
		//         $directory.'/'.$newFilename,
		//         $stream,
		//         [
		//             'visibility' => $isPublic ? AdapterInterface::VISIBILITY_PUBLIC : AdapterInterface::VISIBILITY_PRIVATE,
		//         ]
		//     );
		//
		//     if ($result === FALSE) {
		//         throw new \Exception(sprintf('Could not write uploaded file "%s"', $newFilename));
		//     }
		//
		//     if (is_resource($stream)) {
		//         fclose($stream);
		//     }
		//
		//     return $newFilename;
		// }
		
	}
