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
	 * Class VoteController
	 *
	 * @package App\Controller
	 */
	class VoteController extends AbstractController
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
		 * @Route("/dashboard", name="vote_control_panel")
		 */
		public function control_panel():Response
		{
			return $this->render(
				'vote/control_panel.html.twig',
				[
					'controller_name' => 'voteController',
				]
			);
		}
		
		/**
		 * @Route("/new", name="vote_new")
		 * @IsGranted("ROLE_VOTER")
		 * @param  Request  $request
		 *
		 * @return Response
		 * @throws Exception
		 */
		public function create(Request $request):Response
		{
			return $this->render(
				'vote/create.html.twig',
				[
					'controller_name' => 'voteController',
				]
			);
		}
		
		
		/**
		 * @Route("/update/{vote_id}", name="vote_update")
		 */
		public function update():Response
		{
			return $this->render(
				'vote/update.html.twig',
				[
					'controller_name' => 'voteController',
				]
			);
		}
		
		/**
		 * @Route("/delete/{vote_id}", name="vote_delete")
		 */
		public function delete():Response
		{
			return $this->render(
				'vote/delete.html.twig',
				[
					'controller_name' => 'voteController',
				]
			);
		}
		
		/**
		 * @Route("/denied_access", name="vote_denied_access")
		 */
		public function denied_access():Response
		{
			return $this->render(
				'vote/denied_access.html.twig',
				[
					'controller_name' => 'voteController',
				]
			);
		}
		
		
	}
