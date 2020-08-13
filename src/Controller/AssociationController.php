<?php
	
	namespace App\Controller;
	
	use App\Entity\Company;
	use App\Entity\Person;
	use App\Form\CompanyFormType;
	use App\Repository\CompanyRepository;
	use App\Repository\RelationshipRepository;
	use App\Repository\StatisticsRepository;
	use Exception;
	use Psr\Log\LoggerInterface;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\Routing\Annotation\Route;
	
	/**
	 * Class AssociationController
	 *
	 * @package App\Controller
	 * @Route("/association")
	 * @IsGranted("ROLE_USER")
	 */
	class AssociationController extends AbstractController
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
		 * @Route("/dashboard", name="association_control_panel")
		 * @IsGranted("ROLE_ASSOCIATION_VIEW")
		 * @param  RelationshipRepository  $relationshipRepository
		 *
		 * @return Response
		 */
		public function control_panel(RelationshipRepository $relationshipRepository):Response
		{
			//  TODO  Perform Permissions Check here.
			
			$company_id = $relationshipRepository->findPrimaryCompanyIdByUserId($this->getUser()->getId());
			$company_id = $this->idManager('company', $company_id);
			
			$associations = $relationshipRepository->findAllAssociationsByCompanyId($company_id);
			
			return $this->render(
				'association/control_panel.html.twig',
				[
					'user'         => $this->getUser(),
					'title'        => 'Association Dashboard',
					'associations' => $associations,
				]
			);
		}
		
		
		/**
		 * @Route("/list", name="association_list")
		 * @IsGranted("ROLE_ASSOCIATION_VIEW")
		 * @param  RelationshipRepository  $relationshipRepository
		 *
		 * @return Response
		 */
		public function listAssociations(RelationshipRepository $relationshipRepository):Response
		{
			//  TODO  Perform Permissions Check here.
			
			
			$company_id = $relationshipRepository->findPrimaryCompanyIdByUserId($this->getUser()->getId());
			$company_id = $this->idManager('company', $company_id);
			
			
			
			$associations = $relationshipRepository->findAllAssociationsByCompanyId($company_id);
			
			return $this->render(
				'association/control_panel.html.twig',
				[
					'user'         => $this->getUser(),
					'title'        => 'Association Dashboard',
					'associations' => $associations,
				]
			);
		}
		
		
		
		/**
		 * @Route("/new/{company_id}", name="association_new", requirements={"company_id"="\d+"})
		 * @IsGranted("ROLE_COMPANY_CREATE")
		 * @param  Request                 $request
		 * @param  RelationshipRepository  $relationshipRepository
		 * @param  int                     $company_id
		 *
		 * @return Response
		 * @throws Exception
		 */
		public function create(Request $request, RelationshipRepository $relationshipRepository, int $company_id):Response
		{
			
			$company_id = $this->idManager('company', $company_id);
			
			$company = new Company();
			
			/**
			 * If there is not a company attached to this user,
			 * then lock the first company to the user.
			 * You will need to make sure the first thing happens in Association.
			 */
			$numberOfCompaniesToUser = $relationshipRepository->countNumberOfCompaniesToUser($this->getUser()->getId());
			
			if($numberOfCompaniesToUser < 1){
				$company->setPersonId($this->getUser()->getId());
			}
			
			$form = $this->createForm(CompanyFormType::class, $company);
			$form->remove('displayPhysicalAddress');
			$form->remove('displayMailingAddress');
			$form->remove('displayBillingAddress');
			$form->remove('billingAddress');
			$form->handleRequest($request);
			
			if($form->isSubmitted() && $form->isValid()){
				// dump($company);
				
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->persist($company);
				$entityManager->flush();
				
				/**
				 * Add User to Company
				 */
				$relationshipRepository->addUserToCompanyAsOwner($this->getUser()->getId(), $company->getCompanyId());
				
				return $this->redirectToRoute('company_control_panel');
			}
			
			return $this->render(
				'company/create.html.twig',
				[
					'user'    => $this->getUser(),
					'title'   => 'New Company',
					'company' => $company,
					'form'    => $form->createView(),
				]
			);
		}
		
		
		/**
		 * @Route("/view/{association_id}", name="association_view", methods={"GET","POST"}, requirements={"association_id"="\d+"})
		 * @IsGranted("ROLE_COMPANY_VIEW")
		 * @param  int                $association_id
		 * @param  CompanyRepository  $companyRepository
		 *
		 * @return Response
		 */
		public function view(int $association_id, CompanyRepository $companyRepository):Response
		{
			
			
			$association_id = $this->idManager('association', $association_id);
			
			//  Make sure this use can access this company.
			
			$company = $companyRepository->find($association_id);
			
			// dump($company);
			
			/**
			 * If no Company Object is returned, then send them back to the control panel.
			 */
			if($company === NULL){
				$this->redirectToRoute('company_control_panel');
			}
			
			$nameFormal = $company->getNameFormal();
			
			return $this->render(
				'company/show.html.twig',
				[
					'association_id' => $association_id,
					'user'           => $this->getUser(),
					'title'          => 'Company Information: ' . $nameFormal,
					'company'        => $company,
				]
			);
		}
		
		
		/**
		 * @Route("/edit/{association_id}/", name="association_edit", methods={"GET","POST"}, requirements={"association_id"="\d+"})
		 * @IsGranted("ROLE_COMPANY_EDIT")
		 * @param  int                $association_id
		 * @param  Request            $request
		 * @param  CompanyRepository  $companyRepository
		 *
		 * @return Response
		 */
		public function edit(int $association_id, Request $request, CompanyRepository $companyRepository):Response
		{
			
			
			$association_id = $this->idManager('association', $association_id);
			
			//  Make sure this use can access this company.
			$company = $companyRepository->find($association_id);
			
			/**
			 * If no Company Object is returned, then send them back to the control panel.
			 */
			if($company === NULL){
				$this->redirectToRoute('company_control_panel');
			}
			
			$nameFormal = $company->getNameFormal();
			
			$form = $this->createForm(CompanyFormType::class, $company);
			$form->remove('displayPhysicalAddress');
			$form->remove('displayMailingAddress');
			$form->remove('displayBillingAddress');
			$form->remove('billingAddress');
			
			$form->handleRequest($request);
			
			if($form->isSubmitted() && $form->isValid()){
				$this->getDoctrine()->getManager()->flush();
				
				return $this->redirectToRoute('company_control_panel');
			}
			
			return $this->render(
				'company/edit.html.twig',
				[
					'association_id' => $association_id,
					'user'           => $this->getUser(),
					'company'        => $company,
					'title'          => 'Company Information: ' . $nameFormal,
					'form'           => $form->createView(),
				]
			);
		}
		
		
		/**
		 * @Route("/delete/{companyId}", name="company_delete", methods={"DELETE"}, requirements={"companyId"="\d+"})
		 * @IsGranted("ROLE_COMPANY_DELETE")
		 * @param  Request  $request
		 * @param  Company  $company
		 * @param  int      $companyId
		 *
		 * @return Response
		 * @todo Make the Delete Methods perform a soft delete from Relationship.
		 */
		public function delete(Request $request, Company $company, int $companyId):Response
		{
			
			$company_id = $companyId = $this->idManager('company', $companyId);
			
			//	$company = $com
			
			// TODO Make these a soft delete.
			if($this->isCsrfTokenValid('delete' . $company->getCompanyId(), $request->request->get('_token'))){
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->remove($company);
				$entityManager->flush();
			}
			
			return $this->redirectToRoute('company_control_panel');
		}
		
		
		/**
		 * @Route("/denied_access", name="company_denied_access")
		 */
		public function denied_access():Response
		{
			return $this->render(
				'company/denied_access.html.twig',
				[
					'controller_name' => 'companyController',
				]
			);
		}
		
		
		/**
		 * @deprecated
		 *
		 * @param  StatisticsRepository  $statisticsRepository
		 * @param                        $user_id
		 *
		 * @return bool
		 */
		private function CanUserAddANewAssociation($user_id, StatisticsRepository $statisticsRepository):bool
		{
			$personRepository = $this->getDoctrine()->getRepository(Person::class);
			
			$personTypeId = $personRepository->getPersonTypeByUserId($user_id);
			
			/**
			 * Because they are a Management Company, the the answer is True, they can add a new Association.
			 */
			if($personTypeId === 200){
				return TRUE;
			}
			
			/**
			 * How many Associations does the current user have and if the answer is zero, let them
			 * add a new Association.
			 */
			$number_of_associations = $statisticsRepository->NumberOfAssociationsToUser($user_id);
			
			if($number_of_associations < 1){
				return TRUE;
			}
			
			return FALSE;
		}
		
		
	}
