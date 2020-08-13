<?php
	
	namespace App\Controller;
	
	use App\Repository\RelationshipRepository;
	use Exception;
	use Psr\Log\LoggerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
	
	/**
	 * Class SecurityController
	 *
	 * @package App\Controller
	 */
	class SecurityController extends AbstractController
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
		 * @Route("/login", name="app_login", methods={"GET", "POST"})
		 * @param  AuthenticationUtils  $authenticationUtils
		 *
		 * @return Response
		 */
		public function login(AuthenticationUtils $authenticationUtils):Response
		{
			// get the login error if there is one
			$error = $authenticationUtils->getLastAuthenticationError();
			
			// last username entered by the user
			$lastUsername = $authenticationUtils->getLastUsername();
			
			return $this->render(
				'security/login.html.twig',
				[
					'last_username' => $lastUsername,
					'error'         => $error,
				]
			);
		}
		
		
		/**
		 * @Route("/login/authenticated", name="app_login_post_authenticated")
		 * @param  RelationshipRepository  $relationshipRepository
		 *
		 * @return Response
		 */
		public function post_login_landing(RelationshipRepository $relationshipRepository):Response
		{
			$user_id = $this->getUser()->getId();
			
			/**
			 * If the user does not have a foundation company which they need to log in
			 * send them to the new Company form.
			 */
			if($relationshipRepository->doesUserHaveCompanyRelationship($user_id) === FALSE){
				return $this->redirectToRoute('company_new');
			}
			
			$association_ids = $relationshipRepository->findAllAssociationIdsByUserId($user_id);
			
			$this->session->set('association_ids', $association_ids);
			
			/**
			 * Else, send them to the home page.
			 */
			return $this->redirectToRoute('association_control_panel');
		}
		
		
		/**
		 * @Route("/logout", name="app_logout", methods={"GET"})
		 * @return Response
		 * @throws Exception
		 */
		public function logout():Response
		{
			throw new Exception('Don\'t forget to activate logout in security.yaml');
		}
		
		
		/**
		 * @Route("/change-password", name="app_change_password")
		 * @return Response
		 */
		public function change_password():Response
		{
		}
		
		/**
		 * @Route("/recover-password", name="app_recover_password")
		 * @return Response
		 */
		public function recover_password():Response
		{
		}
		
		
		
		
		// /**
		//  * @Route("/security", name="security")
		//  */
		// public function index():Response
		// {
		//     return $this->render(
		//         'security/index.html.twig',
		//         [
		//             'controller_name' => 'SecurityController',
		//         ]
		//     );
		// }
		
	}
