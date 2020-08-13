<?php
	
	namespace App\Controller;
	
	use App\Entity\Company;
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
	 * Class CompanyController
	 *
	 * @package App\Controller
	 * @Route("/company")
	 * @IsGranted("ROLE_USER")
	 */
	class CompanyController extends AbstractController
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
			//   $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
		}
		
		
		/**
		 * @Route("/dashboard", name="company_control_panel")
		 * @IsGranted("ROLE_COMPANY_VIEW")
		 * @param  RelationshipRepository  $relationshipRepository
		 * @param  CompanyRepository       $companyRepository
		 *
		 * @return Response
		 */
		public function control_panel(RelationshipRepository $relationshipRepository, CompanyRepository $companyRepository):Response
		{
			// TODO List only the companies associated with this user.
			
			$user_id = $this->getUser()->getId();
			
			$user_id = $this->idManager('user', $user_id);
			
			$company_id = $relationshipRepository->findPrimaryCompanyIdByUserId($user_id);
			
			$company_id = $this->idManager('company', $company_id);
			
			$company = $companyRepository->findBy(['companyId' => $company_id]);
			
			return $this->render(
				'company/control_panel.html.twig',
				[
					'user'       => $this->getUser(),
					'title'      => 'Company Control Panel',
					'companies'  => $company,
					'company_id' => $company_id,
				]
			);
		}
		
		
		/**
		 * @Route("/new", name="company_new")
		 * @IsGranted("ROLE_COMPANY_CREATE")
		 * @param  Request                 $request
		 * @param  StatisticsRepository    $stats
		 * @param  RelationshipRepository  $relationshipRepository
		 *
		 * @return Response
		 * @throws Exception
		 */
		public function create(Request $request, StatisticsRepository $stats, RelationshipRepository $relationshipRepository):Response
		{
			
			
			// $user_id = $this->getUser()->getId();
			// $user_id = $this->idManager('user', $user_id);
			
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
		 * @Route("/view/{company_id}", name="company_view", methods={"GET"}, requirements={"company_id"="\d+"})
		 * @IsGranted("ROLE_COMPANY_VIEW")
		 * @param                     $company_id
		 * @param  CompanyRepository  $companyRepository
		 *
		 * @return Response
		 */
		public function view(int $company_id, CompanyRepository $companyRepository):Response
		{
			
			$company_id = $this->idManager('company', $company_id);
			
			//  Make sure this use can access this company.
			
			$company = $companyRepository->find($company_id);
			
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
					
					'user'    => $this->getUser(),
					'title'   => 'Company Information: ' . $nameFormal,
					'company' => $company,
				]
			);
		}
		
		/**
		 * @Route("/edit/{company_id}/", name="company_edit", methods={"GET","POST"}, requirements={"company_id"="\d+"})
		 * @IsGranted("ROLE_COMPANY_EDIT")
		 * @param  int                $company_id
		 * @param  Request            $request
		 * @param  CompanyRepository  $companyRepository
		 *
		 * @return Response
		 */
		public function edit(int $company_id, Request $request, CompanyRepository $companyRepository):Response
		{
			$company_id = $this->idManager('company', $company_id);
			
			//  Make sure this use can access this company.
			$company = $companyRepository->find($company_id);
			
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
					'user'    => $this->getUser(),
					'company' => $company,
					'title'   => 'Company Information: ' . $nameFormal,
					'form'    => $form->createView(),
				]
			);
		}
		
		
		/**
		 * @Route("/delete/{companyId}", name="company_delete", methods={"DELETE"}, requirements={"companyId"="\d+"})
		 * @IsGranted("ROLE_COMPANY_DELETE")
		 * @param  Request  $request
		 * @param  Company  $company
		 *
		 * @return Response
		 */
		public function delete(Request $request, Company $company):Response
		{
			// TODO Make these soft deletes so they are not permanently deleted.
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
		
	}
