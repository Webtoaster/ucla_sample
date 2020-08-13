<?php
	
	namespace App\Controller;
	
	use App\Entity\Company;
	use App\Form\CompanyFormType;
	use Exception;
	use Psr\Log\LoggerInterface;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\Routing\Annotation\Route;
	
	/**
	 * Class StaffController
	 *
	 * @package App\Controller
	 */
	class StaffController extends AbstractController
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
		 * @Route("/new", name="staff_new")
		 * @IsGranted("ROLE_COMPANY")
		 * @param  Request  $request
		 *
		 * @return Response
		 * @throws Exception
		 */
		public function create(Request $request):Response
		{
			$company = new Company();
			$form    = $this->createForm(CompanyFormType::class, $company);
			$form->handleRequest($request);
			
			if($form->isSubmitted() && $form->isValid()){
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->persist($company);
				$entityManager->flush();
				
				return $this->redirectToRoute('company_control_panel');
			}
			
			return $this->render(
				'staff/create.html.twig',
				[
					'company' => $company,
					'form'    => $form->createView(),
				]
			);
		}
		
		
		/**
		 * @Route("/dashboard", name="staff_control_panel")
		 */
		public function control_panel():Response
		{
			return $this->render(
				'staff/control_panel.html.twig',
				[
					'controller_name' => 'staffController',
				]
			);
		}
		
		
		/**
		 * @Route("/update/{staff_id}", name="staff_update")
		 */
		public function update():Response
		{
			return $this->render(
				'staff/update.html.twig',
				[
					'controller_name' => 'staffController',
				]
			);
		}
		
		/**
		 * @Route("/delete/{staff_id}", name="staff_delete")
		 */
		public function delete():Response
		{
			return $this->render(
				'staff/delete.html.twig',
				[
					'controller_name' => 'staffController',
				]
			);
		}
		
		/**
		 * @Route("/denied_access", name="staff_denied_access")
		 */
		public function denied_access():Response
		{
			return $this->render(
				'staff/denied_access.html.twig',
				[
					'controller_name' => 'staffController',
				]
			);
		}
		
		
	}
