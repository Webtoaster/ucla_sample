<?php
	
	namespace App\Controller;
	
	use App\Entity\Person;
	use App\Form\PersonFormType;
	use Exception;
	use Psr\Log\LoggerInterface;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\Routing\Annotation\Route;
	
	/**
	 * Class AdminController
	 *
	 * @package App\Controller
	 * @Route("/candidate")
	 * @IsGranted("ROLE_USER")
	 */
	class CandidateController extends AbstractController
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
		 * @Route("/new/{election_id}", name="candidate_new", methods={"GET","POST"}, requirements={"election_id"="\d+"})
		 * @IsGranted("ROLE_CANDIDATE_CREATE")
		 * @param  Request  $request
		 * @param  int      $election_id
		 *
		 * @return Response
		 * @throws Exception
		 */
		public function create(Request $request, int $election_id):Response
		{
			
			$election_id = $this->idManager('election', $election_id);
			
			$person = new Person();
			$form   = $this->createForm(PersonFormType::class, $person);
			$form->handleRequest($request);
			
			if($form->isSubmitted() && $form->isValid()){
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->persist($person);
				
				$entityManager->flush();
				
				return $this->redirectToRoute('candidate_control_panel');
			}
			
			return $this->render(
				'candidate/create.html.twig',
				[
					'person' => $person,
					'form'   => $form->createView(),
				]
			);
		}
		
		
		/**
		 * @Route("/dashboard/{election_id}", name="candidate_control_panel", requirements={"election_id"="\d+"})
		 * @param  int      $election_id
		 * @param  Request  $request
		 *
		 * @return Response
		 */
		public function control_panel(int $election_id, Request $request):Response
		{
			
			$election_id = $this->idManager('election', $election_id);
			
			return $this->render(
				'candidate/control_panel.html.twig',
				[
					'controller_name' => 'CandidateController',
				]
			);
		}
		
		
		/**
		 * @Route("/update/{candidate_id}", name="candidate_update", requirements={"candidate_id"="\d+"})
		 * @param  int      $candidate_id
		 * @param  Request  $request
		 *
		 * @return Response
		 */
		public function update(int $candidate_id, Request $request):Response
		{
			
			$candidate_id = $this->idManager('candidate', $candidate_id);
			
			return $this->render(
				'candidate/update.html.twig',
				[
					'controller_name' => 'CandidateController',
				]
			);
		}
		
		/**
		 * @Route("/delete/{candidate_id}", name="candidate_delete", requirements={"candidate_id"="\d+"})
		 */
		public function delete():Response
		{
			return $this->render(
				'candidate/delete.html.twig',
				[
					'controller_name' => 'CandidateController',
				]
			);
		}
		
		/**
		 * @Route("/denied_access", name="candidate_denied_access")
		 */
		public function denied_access():Response
		{
			return $this->render(
				'candidate/denied_access.html.twig',
				[
					'controller_name' => 'CandidateController',
				]
			);
		}
		
	}
