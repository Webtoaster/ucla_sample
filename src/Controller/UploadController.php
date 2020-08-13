<?php
	
	namespace App\Controller;
	
	use App\Entity\Upload;
	use App\Form\UploadType;
	use App\Repository\RelationshipRepository;
	use App\Repository\UploadRepository;
	use App\Service\UploaderHelper;
	use Psr\Log\LoggerInterface;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\File\UploadedFile;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\Routing\Annotation\Route;
	
	/**
	 * Class UploadController
	 *
	 * @package App\Controller
	 * @Route("/upload")
	 * @IsGranted("ROLE_USER")
	 */
	class UploadController extends AbstractController
	{
		
		
		use ControllerCommonTraits;
		
		
		/**
		 * RegistrationController constructor.
		 *
		 * @param  SessionInterface  $session
		 * @param  LoggerInterface   $logger
		 */
		public function __construct(SessionInterface $session, LoggerInterface $logger)
		{
			$this->session = $session;
			$this->logger  = $logger;
		}
		
		/**
		 * @Route("/", name="upload_index", methods={"GET"})
		 * @param  Request  $request
		 *
		 * @return Response
		 */
		public function index(Request $request):Response
		{
			
			return $this->render(
				'upload/index.html.twig',
				[
				
				]
			);
		}
		
		
		/**
		 * @Route("/property_file/{association_id}", name="upload_property_file", requirements={"association_id"="\d+"})
		 * @param  Request                 $request
		 * @param  UploaderHelper          $uploaderHelper
		 * @param  UploadRepository        $uploadRepository
		 * @param  RelationshipRepository  $relationship
		 * @param  int                     $association_id
		 *
		 * @return Response
		 */
		public function upload_property_file(Request $request, UploaderHelper $uploaderHelper, UploadRepository $uploadRepository,
		                                     RelationshipRepository $relationship,
		                                     int $association_id):Response
		{
			
			$association_id = $this->idManager('association', $association_id);
			
			//  todo    Perform a security check here.
			
			$company_id = $relationship->findPrimaryCompanyIdByAssociationId($association_id);
			
			$company_id = $this->idManager('company', $company_id);
			
			// TODO Make sure there is a check for uploading here.
			
			/**
			 * Set the max upload size via an environmental variable.
			 */
			ini_set('upload_max_filesize', $_ENV['DATA_UPLOAD_MAX_SIZE']);
			ini_set('post_max_size ', $_ENV['DATA_UPLOAD_MAX_SIZE']);
			
			// Upload $upload,
			
			// dd($upload);
			
			$upload = new Upload();
			
			$form = $this->createForm(UploadType::class, $upload);
			
			$form->remove('newFileName')
			     ->remove('originalUploadedFileName')
			     ->remove('mimeType')
			     ->remove('guessedFileExtension')
			     ->remove('absoluteFilePath')
			     ->remove('webPath')
			     ->remove('createdFromIp')
			     ->remove('updatedFromIp')
			     ->remove('createdAt')
			     ->remove('updatedAt')
			     ->remove('isActive')
			;
			
			$form->handleRequest($request);
			
			if($form->isSubmitted() && $form->isValid()){
				
				
				/** @var UploadedFile $uploadedFile */
				$uploadedFile = $form['dataFile']->getData();
				
				if($uploadedFile){
					$newFileArray = $uploaderHelper->uploadDataFile($uploadedFile, $association_id);
					
					$upload_id = $uploadRepository->addUploadedDataFile(
						$association_id,
						$newFileArray['originalUploadedFileName'],
						$newFileArray['newFileName'],
						$newFileArray['mimeType'],
						$newFileArray['guessedFileExtension'],
						$newFileArray['newAbsoluteFilePath'],
						$newFileArray['newWebPath']
					);
					
					// dd($upload_id);
					
					if($upload_id > 0){
						$this->addFlash('info', 'Your File Uploaded Properly.');
						
						$this->session->set('current_upload_id', $upload_id);
						
						return $this->redirectToRoute('import_parse_upload');
					}
				}
				
				$this->addFlash('error', 'You did not select a file to uploaded . ');
			}
			
			return $this->render(
				'upload/new.html.twig',
				[
					'upload' => $upload,
					'form'   => $form->createView(),
				]
			);
		}
		
		
		/**
		 * @Route("/{uploadId}", name="upload_show", methods={"GET"})
		 * @param  int     $upload_id
		 * @param  Upload  $upload
		 *
		 * @return Response
		 */
		public function show(int $upload_id, Upload $upload):Response
		{
			
			$upload_id = $this->idManager('upload', $upload_id);
			
			return $this->render(
				'upload/show.html.twig',
				[
					'upload' => $upload,
				]
			);
		}
		
		
		/**
		 * @Route("/{upload_id}/edit", name="upload_edit", methods={"GET","POST"})
		 * @param  Request  $request
		 * @param  Upload   $upload
		 *
		 * @return Response
		 */
		public
		function edit(int $upload_id, Request $request, Upload $upload):Response
		{
			$form = $this->createForm(UploadType::class, $upload);
			$form->handleRequest($request);
			
			if($form->isSubmitted() && $form->isValid()){
				$this->getDoctrine()->getManager()->flush();
				
				return $this->redirectToRoute('upload_index');
			}
			
			return $this->render(
				'upload/edit.html.twig',
				[
					'upload' => $upload,
					'form'   => $form->createView(),
				]
			);
		}
		
		
		/**
		 * @Route("/{uploadId}", name="upload_delete", methods={"DELETE"})
		 * @param  Request  $request
		 * @param  Upload   $upload
		 *
		 * @return Response
		 */
		public
		function delete(Request $request, Upload $upload):Response
		{
			if($this->isCsrfTokenValid('delete' . $upload->getUploadId(), $request->request->get('_token'))){
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->remove($upload);
				$entityManager->flush();
			}
			
			return $this->redirectToRoute('upload_index');
		}
	}