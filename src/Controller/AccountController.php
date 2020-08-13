<?php
	
	namespace App\Controller;
	
	use App\Entity\PersonType;
	use App\Repository\PersonRepository;
	use Psr\Log\LoggerInterface;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\Routing\Annotation\Route;
	
	/**
	 * Class AccountController
	 *
	 * @package App\Controller
	 * @Route("/account")
	 * @IsGranted("ROLE_USER")
	 */
	class AccountController extends AbstractController
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
		 * @Route("/my_account/edit", name="my_account_edit")
		 * @param  Request           $request
		 * @param  PersonRepository  $personRepository
		 *
		 * @return Response
		 */
		public function my_account_edit(Request $request, PersonRepository $personRepository):Response
		{
			$user_id = $this->idManager('user', $this->getUser()->getId());
			
			$person = $personRepository->find($user_id);
			
			$form = $this->createForm(PersonType::class, $person);
			$form->handleRequest($request);
			
			if($form->isSubmitted() && $form->isValid()){
				$this->getDoctrine()->getManager()->flush();
				
				return $this->redirectToRoute('my_account_view');
			}
			
			return $this->render(
				'person/update.html.twig',
				[
					'person' => $person,
					'form'   => $form->createView(),
				]
			);
		}
		
		
		/**
		 * @Route("/my_account/view", name="my_account_view", methods={"GET","POST"})
		 * @param  PersonRepository  $personRepository
		 *
		 * @return Response
		 */
		public function my_account_view(PersonRepository $personRepository):Response
		{
			
			$user_id = $this->idManager('user', $this->getUser()->getId());
			
			$person = $personRepository->find($user_id);
			
			return $this->render(
				'person/view.html.twig',
				[
					'person' => $person,
				]
			);
		}
		
		
	}
