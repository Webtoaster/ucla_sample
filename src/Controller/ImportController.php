<?php
	
	namespace App\Controller;
	
	use App\Entity\Import;
	use App\Form\ImportType;
	use App\Helper\SpreadsheetParser;
	use App\Repository\CompanyRepository;
	use App\Repository\ImportRepository;
	use App\Repository\UploadRepository;
	use PhpOffice\PhpSpreadsheet\Reader\Exception;
	use Psr\Log\LoggerInterface;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\Routing\Annotation\Route;
	
	/**
	 * Class ImportController
	 *
	 * @package App\Controller
	 * @Route("/import")
	 * @IsGranted("ROLE_USER")
	 */
	class ImportController extends AbstractController
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
		 * @Route("/parse_upload", name="import_parse_upload", methods={"GET"})
		 * @param  UploadRepository   $upload
		 * @param  ImportRepository   $import
		 * @param  SpreadsheetParser  $parser
		 *
		 * @return Response
		 * @throws \PhpOffice\PhpSpreadsheet\Exception
		 * @throws Exception
		 */
		public function parse_upload(UploadRepository $upload, ImportRepository $import, SpreadsheetParser $parser):Response
		{
			
			$upload_id      = $this->idManager('upload', 0);
			$association_id = $this->idManager('association', 0);
			$company_id     = $this->idManager('company', 0);
			
			/**
			 * If the user ends up here by accident, then toss them to the Control Panel
			 */
			if($upload_id < 1){
				return $this->redirectToRoute('import_control_panel');
			}
			
			/**
			 * Parse the spreadsheet.
			 *
			 * @var array $data
			 */
			$data = $parser->parseSpreadsheetFile($upload_id, $upload);
			
			/**
			 * Import the parsed array into the Import table.  The result will be the records that have been imported.
			 */
			$count = $import->importSpreadsheetData($data, $association_id, $company_id, $upload_id);
			
			/**
			 * If the number of records imported is more than zero, then add flash and redirect them to the page
			 * notifying them of a successful upload to the database.
			 */
			if($count > 0){
				
				$this->addFlash('info', $count . ' Records have been imported.');
				
				return $this->redirectToRoute('import_upload_parsed');
			}
			
			/**
			 * So the count was zero.  There is an error in the importation of the data.
			 * Put that into a flash message.
			 */
			$this->addFlash('error', 'Your upload was not parsed correctly.&nbsp;   Please check your file and try again. ');
			
			/**
			 * Show them the import errors template.
			 */
			return $this->render(
				'import/import_errors.html.twig',
				[
				
				]
			);
		}
		
		
		/**
		 * @Route("/view_imported_records/{import_id}", name="import_view_imported_records", methods={"GET"}, requirements={"import_id"="\d+"})
		 * @param  int               $import_id
		 * @param  UploadRepository  $uploadRepository
		 * @param  ImportRepository  $importRepository
		 *
		 * @return Response
		 */
		public function view_imported_records(int $import_id, UploadRepository $uploadRepository, ImportRepository $importRepository):Response
		{
			$import_id = $this->idManager('import', $import_id);
			
			return $this->render(
				'import/import.html.twig',
				[
					
					//   'upload'  => $upload,
					// 'uploads' => $uploadRepository->findAll(),
				]
			);
		}
		
		
		/**
		 * @Route("/upload_parsed", name="import_upload_parsed", methods={"GET"})
		 * @param  UploadRepository  $uploadRepository
		 * @param  ImportRepository  $importRepository
		 *
		 * @return Response
		 */
		public function upload_parsed(UploadRepository $uploadRepository, ImportRepository $importRepository):Response
		{
			
			$upload_id      = $this->idManager('upload', 0);
			$association_id = $this->idManager('association', 0);
			$company_id     = $this->idManager('company', 0);
			
			return $this->render(
				'import/import.html.twig',
				[
					'upload_id' => $upload_id,
					//   'upload'  => $upload,
					// 'uploads' => $uploadRepository->findAll(),
				]
			);
		}
		
		
		/**
		 * @Route("/dashboard/{association_id}", name="import_control_panel")
		 * @param  int  $association_id
		 *
		 * @return Response
		 */
		public function control_panel(int $association_id):Response
		{
			$association_id = $this->idManager('association', $association_id);
			
			return $this->render(
				'import/control_panel.html.twig',
				[
					'controller_name' => 'importController',
				]
			);
		}
		
		
		/**
		 * @Route("/denied_access", name="import_denied_access")
		 */
		public function denied_access():Response
		{
			return $this->render(
				'import/denied_access.html.twig',
				[
					'controller_name' => 'importController',
				]
			);
		}
		
		
		
		
		
		//  CRUD METHODS BELOW THIS POINT.
		//  CRUD METHODS BELOW THIS POINT.
		//  CRUD METHODS BELOW THIS POINT.
		//  CRUD METHODS BELOW THIS POINT.
		//  CRUD METHODS BELOW THIS POINT.
		//  CRUD METHODS BELOW THIS POINT.
		//  CRUD METHODS BELOW THIS POINT.
		
		/**
		 * @Route("/review/list/{upload_id}", name="import_index", methods={"GET"}, requirements={"upload_id"="\d+"})
		 * @param  int               $upload_id
		 * @param  ImportRepository  $importRepository
		 *
		 * @return Response
		 */
		public function index(int $upload_id, ImportRepository $importRepository):Response
		{
			$upload_id = $this->idManager('upload', $upload_id);
			
			$imports = $importRepository->findBy([
					'upload' => $upload_id,
				]
			);
			
			dump($imports);
			
			return $this->render('import_review/index.html.twig',
				[
					'imports' => $imports,
				]
			
			);
		}
		
		/**
		 * @Route("/review/new", name="import_new", methods={"GET","POST"})
		 * @param  Request           $request
		 * @param  UploadRepository  $uploadRepository
		 *
		 * @return Response
		 */
		public function new(Request $request, UploadRepository $uploadRepository):Response
		{
			
			$association_id = $this->idManager('association', 0);
			
			$import = new Import();
			$form   = $this->createForm(ImportType::class, $import);
			$form->handleRequest($request);
			
			if($form->isSubmitted() && $form->isValid()){
				$entityManager = $this->getDoctrine()->getManager();
				
				$import->setUpload($uploadRepository->find($this->session->get('upload_id')));
				
				$entityManager->persist($import);
				$entityManager->flush();
				
				return $this->redirectToRoute('import_index');
			}
			
			return $this->render('import_review/new.html.twig',
				[
					'import' => $import,
					'form'   => $form->createView(),
				]
			);
		}
		
		/**
		 * @Route("/review/show/{import_id}", name="import_show")
		 * @param  ImportRepository   $importRepository
		 * @param  CompanyRepository  $companyRepository
		 * @param  int                $import_id
		 *
		 * @return Response
		 */
		public function show(int $import_id, ImportRepository $importRepository, CompanyRepository $companyRepository):Response
		{
			$import_id = $this->idManager('import', $import_id);
			$upload_id = $this->idManager('upload', 0);
			
			$import = $importRepository->find($import_id);
			
			$association_id = $import->getAssociationId();
			
			$association_id = $this->idManager('association', $association_id);
			
			$association = $companyRepository->find($association_id);
			
			// dd($upload_id);
			
			return $this->render('import_review/show.html.twig',
				[
					'import'      => $import,
					'upload_id'   => $upload_id,
					'association' => $association,
				]
			);
		}
		
		/**
		 * @Route("/review/edit/{importId}", name="import_edit", methods={"GET","POST"})
		 * @param  Request  $request
		 * @param  Import   $import
		 *
		 * @return Response
		 */
		public function edit(Request $request, Import $import):Response
		{
			
			$upload_id = $this->idManager('upload', 0);
			
			$form = $this->createForm(ImportType::class, $import);
			
			$form->remove('upload');
			
			$form->handleRequest($request);
			
			if($form->isSubmitted() && $form->isValid()){
				$this->getDoctrine()->getManager()->flush();
				
				return $this->redirectToRoute('import_index');
			}
			
			return $this->render('import_review/edit.html.twig',
				[
					'import'    => $import,
					'form'      => $form->createView(),
					'upload_id' => $upload_id,
				]
			);
		}
		
		/**
		 * @Route("/modify/delete/{importId}", name="import_delete", methods={"DELETE"})
		 * @param  Request  $request
		 * @param  Import   $import
		 *
		 * @return Response
		 */
		public function delete(Request $request, Import $import):Response
		{
			if($this->isCsrfTokenValid('delete' . $import->getImportId(), $request->request->get('_token'))){
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->remove($import);
				$entityManager->flush();
			}
			
			return $this->redirectToRoute('import_index');
		}
		
		
	}
