<?php
	
	namespace App\Controller;
	
	use Gedmo\Sluggable\Util\Urlizer;
	use RuntimeException;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\File\UploadedFile;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\Routing\Annotation\Route;
	
	/**
	 * Class UploadController
	 *
	 * @package App\Controller
	 * @Route("/upload")
	 * @IsGranted("ROLE_USER")
	 */
	class UploadControllerX extends AbstractController
	{
		
		
		/**
		 * @Route("/test", name="upload-test")
		 * @param  Request  $request
		 *
		 * @return Response
		 */
		public function temporaryUploadAction(Request $request):Response
		{
			$association_id = 865;
			
			$directoryName = $this->getParameter('kernel.project_dir') . '/public/uploads/' . $association_id;
			if(!is_dir($directoryName)){
				//Directory does not exist, so lets create it.
				if(!mkdir($directoryName, 0755, TRUE) && !is_dir($directoryName)){
					throw new RuntimeException(sprintf('Directory "%s" was not created', $directoryName));
				}
			}
			
			/** @var UploadedFile $uploadedFile */
			$uploadedFile = $request->files->get('data_file');
			
			$date = date('Y-m-d_H-i-s');
			
			$originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
			
			// Be sure to use the guessExtension method and not the guessClientExtension method
			// because the latter can't be trusted.
			$newFileName = Urlizer::urlize($originalFilename) . '-' . $date . '.' . $uploadedFile->guessExtension();
			
			dd(
				$uploadedFile->move(
					$directoryName,
					$newFileName
				)
			);
		}
		
		
		/**
		 * @Route("/", name="upload")
		 */
		public function index():Response
		{
			return $this->render(
				'upload/index.html.twig',
				[
					'controller_name' => 'UploadController',
				]
			);
		}
		
	}
