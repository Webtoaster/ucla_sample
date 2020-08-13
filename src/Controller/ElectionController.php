<?php
	
	namespace App\Controller;
	
	use App\Entity\Election;
	use App\Form\ElectionFormType;
	use App\Repository\AssociationRepository;
	use App\Repository\ElectionRepository;
	use App\Repository\RelationshipRepository;
	use Doctrine\DBAL\DBALException;
	use Psr\Log\LoggerInterface;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\Routing\Annotation\Route;
	
	/**
	 * Class ElectionController
	 *
	 * @package App\Controller
	 * @Route("/election")
	 * @IsGranted("ROLE_USER")
	 */
	class ElectionController extends AbstractController
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
		 * @Route("/dashboard/{association_id}", name="election_control_panel", requirements={"association_id"="\d+"})
		 * @IsGranted("ROLE_ELECTION_VIEW")
		 * @param  Request                 $request
		 * @param                          $association_id
		 * @param  ElectionRepository      $electionRepository
		 * @param  RelationshipRepository  $relationshipRepository
		 *
		 * @return Response
		 * @throws DBALException
		 */
		public function control_panel(Request $request, $association_id, ElectionRepository $electionRepository,
		                              RelationshipRepository $relationshipRepository):Response
		{
			
			$association_id = $this->idManager('association', $association_id);
			
			$association = $relationshipRepository->findAssociationByAssociationId($association_id);
			
			$association_id = $association['associationId'];
			
			$elections = $electionRepository->findBy(
				[
					'association' => $association_id,
					'isActive'    => 1,
				]
			);
			
			// dd($association);
			
			return $this->render(
				'election/control_panel.html.twig',
				[
					'association_id' => $association_id,
					'association'    => $association,
					'elections'      => $elections,
					'site_name'      => 'Election Dashboard',
				
				]
			);
		}
		
		
		/**
		 * @Route("/new/{association_id}", name="election_new", requirements={"association_id"="\d+"})
		 * @IsGranted("ROLE_ELECTION_CREATE")
		 * @param  Request                $request
		 * @param                         $association_id
		 * @param  ElectionRepository     $electionRepository
		 * @param  AssociationRepository  $associationRepository
		 *
		 * @return Response
		 */
		public function create(Request $request, $association_id, ElectionRepository $electionRepository,
		                       AssociationRepository $associationRepository):Response
		{
			$association_id = $this->idManager('association', $association_id);
			
			$association = $associationRepository->find($association_id);
			
			if($association === NULL){
				return $this->redirectToRoute('association_control_panel');
			}
			
			dump($association);
			
			$election = new Election();
			
			$election->setElectionState($association->getPhysicalAddressState());
			$election->setPhysicalAddressLine1($association->getPhysicalAddressLine1());
			$election->setPhysicalAddressLine2($association->getPhysicalAddressLine2());
			$election->setPhysicalAddressCity($association->getPhysicalAddressCity());
			$election->setPhysicalAddressState($association->getPhysicalAddressState());
			$election->setPhysicalAddressZipCode($association->getPhysicalAddressZipCode());
			
			$election->setElectionState($association->getPhysicalAddressState());
			$election->setMailingAddressLine1($association->getMailingAddressLine1());
			$election->setMailingAddressLine2($association->getMailingAddressLine2());
			$election->setMailingAddressCity($association->getMailingAddressCity());
			$election->setMailingAddressState($association->getMailingAddressState());
			$election->setMailingAddressZipCode($association->getMailingAddressZipCode());
			
			$election->setVotesMax($association->getNumberOfProperties());
			
			$form = $this->createForm(ElectionFormType::class, $election);
			$form->remove('displayPhysicalAddress');
			$form->remove('displayMailingAddress');
			
			$form->handleRequest($request);
			
			if($form->isSubmitted() && $form->isValid()){
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->persist($election);
				$entityManager->flush();
				
				return $this->redirectToRoute('election_control_panel', ['association_id' => $association_id]);
			}
			
			return $this->render(
				'election/create.html.twig',
				[
					'form'            => $form->createView(),
					'association'     => $association,
					'election'        => $election,
					'controller_name' => 'electionController',
				]
			);
		}
		
		
		/**
		 * @Route("/update/{election_id}", name="election_update", requirements={"election_id"="\d+"})
		 * @param  Request                $request
		 * @param                         $election_id
		 * @param  ElectionRepository     $electionRepository
		 * @param  AssociationRepository  $associationRepository
		 *
		 * @return Response
		 */
		public function update(Request $request, $election_id, ElectionRepository $electionRepository,
		                       AssociationRepository $associationRepository):Response
		{
			$election_id = $this->idManager('election', $election_id);
			
			$election = $electionRepository->find($election_id);
			
			return $this->render(
				'election/update.html.twig',
				[
					'controller_name' => 'electionController',
				]
			);
		}
		
		/**
		 * @Route("/delete/{election_id}", name="election_delete", requirements={"election_id"="\d+"})
		 * @param  Request                $request
		 * @param                         $election_id
		 * @param  ElectionRepository     $electionRepository
		 * @param  AssociationRepository  $associationRepository
		 *
		 * @return Response
		 */
		public function delete(Request $request, $election_id, ElectionRepository $electionRepository,
		                       AssociationRepository $associationRepository):Response
		{
			$election_id = $this->idManager('election', $election_id);
			
			$election = $electionRepository->find($election_id);
			
			return $this->render(
				'election/delete.html.twig',
				[
					'controller_name' => 'electionController',
				]
			);
		}
		
		/**
		 * @Route("/denied_access", name="election_denied_access")
		 * @param  Request  $request
		 *
		 * @return Response
		 */
		public function denied_access(Request $request):Response
		{
			return $this->render(
				'election/denied_access.html.twig',
				[
					'controller_name' => 'electionController',
				]
			);
		}
		
		
	}
