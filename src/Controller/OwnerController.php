<?php
	
	namespace App\Controller;
	
	use Psr\Log\LoggerInterface;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\Routing\Annotation\Route;
	
	/**
	 * Class OwnerController
	 *
	 * @package App\Controller
	 * @Route("/owmer")
	 * @IsGranted("ROLE_USER")
	 */
	class OwnerController extends AbstractController
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
		 * @Route("/new/{association_id}", name="owner_new", methods={"GET","POST"}, requirements={"association_id"="\d+"})
		 * @IsGranted("ROLE_OWNER_CREATE")
		 * @param  int      $association_id
		 * @param  Request  $request
		 *
		 * @return Response
		 */
		public function create(int $association_id, Request $request):Response
		{
			
			$association_id = $this->idManager('association', $association_id);
			
			return $this->render(
				'owner/create.html.twig',
				[
					'controller_name' => 'ownerController',
				]
			);
		}
		
		
		/**
		 * @Route("/dashboard/{association_id}", name="owner_control_panel", methods={"GET","POST"}, requirements={"association_id"="\d+"})
		 * @param  int  $association_id
		 *
		 * @return Response
		 */
		public function control_panel(int $association_id):Response
		{
			$association_id = $this->idManager('association', $association_id);
			
			return $this->render(
				'owner/control_panel.html.twig',
				[
					'controller_name' => 'ownerController',
				]
			);
		}
		
		
		/**
		 * @Route("/update/{owner_id}", name="owner_update")
		 * @param  int  $owner_id
		 *
		 * @return Response
		 */
		public function update(int $owner_id):Response
		{
			$owner_id = $this->idManager('owner', $owner_id);
			
			return $this->render(
				'owner/update.html.twig',
				[
					'controller_name' => 'ownerController',
				]
			);
		}
		
		/**
		 * @Route("/delete/{owner_id}", name="owner_delete")
		 * @param  int  $owner_id
		 *
		 * @return Response
		 */
		public function delete(int $owner_id):Response
		{
			
			$owner_id = $this->idManager('owner', $owner_id);
			
			return $this->render(
				'owner/delete.html.twig',
				[
					'controller_name' => 'ownerController',
				]
			);
		}
		
		/**
		 * @Route("/denied_access", name="owner_denied_access")
		 */
		public function denied_access():Response
		{
			return $this->render(
				'owner/denied_access.html.twig',
				[
					'controller_name' => 'ownerController',
				]
			);
		}
		
		
	}
