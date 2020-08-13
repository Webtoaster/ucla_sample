<?php
	
	namespace App\Controller;
	
	use Exception;
	use Psr\Log\LoggerInterface;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\Routing\Annotation\Route;
	
	/**
	 * Class UserController
	 *
	 * @package App\Controller
	 */
	class UserController extends AbstractController
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
		 * @Route("/dashboard", name="person_control_panel")
		 */
		public function control_panel():Response
		{
			return $this->render(
				'person/control_panel.html.twig',
				[
					'controller_name' => 'personController',
				]
			);
		}
		
		/**
		 * @Route("/new", name="user_new")
		 * @IsGranted("ROLE_COMPANY_USER_CREATE")
		 * @param  Request  $request
		 *
		 * @return Response
		 * @throws Exception
		 */
		public function create(Request $request):Response
		{
			return $this->render(
				'person/create.html.twig',
				[
					'controller_name' => 'personController',
				]
			);
		}
		
		
		/**
		 * @Route("/update/{person_id}", name="person_update", methods={"GET","POST"}, requirements={"person_id"="\d+"})
		 * @param  int  $person_id
		 *
		 * @return Response
		 */
		public function update(int $person_id):Response
		{
			
			
			$person_id = $this->idManager('person', $person_id);
			
			return $this->render(
				'person/update.html.twig',
				[
					'controller_name' => 'personController',
				]
			);
		}
		
		/**
		 * @Route("/delete/{person_id}", name="person_delete")
		 */
		public function delete():Response
		{
			return $this->render(
				'person/delete.html.twig',
				[
					'controller_name' => 'personController',
				]
			);
		}
		
		/**
		 * @Route("/denied_access", name="person_denied_access")
		 */
		public function denied_access():Response
		{
			return $this->render(
				'person/denied_access.html.twig',
				[
					'controller_name' => 'personController',
				]
			);
		}
		
		
	}
