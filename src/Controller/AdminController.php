<?php
	
	namespace App\Controller;
	
	use App\Repository\CompanyRepository;
	use App\Repository\ElectionRepository;
	use Psr\Log\LoggerInterface;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\Routing\Annotation\Route;
	
	/**
	 * Class AdminController
	 * @Route("/admin")
	 * @IsGranted("ROLE_GROUP_COMPANY_MANAGER")
	 *
	 * @package App\Controller
	 */
	class AdminController extends AbstractController
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
		 * @Route("/dashboard", name="admin_control_panel")
		 */
		public function control_panel():Response
		{
			return $this->render(
				'admin/control_panel.html.twig',
				[
					'controller_name' => 'AdminController',
				]
			);
		}
		
		/**
		 * @Route("/show_association/{association_id}", name="admin_show_association", methods={"GET","POST"}, requirements={"association_id"="\d+"})
		 * @param  int                $association_id
		 * @param  CompanyRepository  $companyRepository
		 *
		 * @return Response
		 */
		public function show_association(int $association_id, CompanyRepository $companyRepository):Response
		{
			
			$association_id = $this->idManager('association', $association_id);
			
			$company = $companyRepository->find($association_id);
			
			return $this->render(
				'admin/show_association.html.twig',
				[
					'company'         => $company,
					'controller_name' => 'AdminController',
				]
			);
		}
		
		
		/**
		 * @Route("/show_elections", name="admin_show_elections", methods={"GET","POST"}, requirements={"association_id"="\d+"})
		 * @param  int                 $association_id
		 * @param  ElectionRepository  $electionRepository
		 *
		 * @return Response
		 */
		public function show_elections(int $association_id, ElectionRepository $electionRepository):Response
		{
			$association_id = $this->idManager('association', $association_id);
			
			$elections = $electionRepository->findBy(['associationId' => $association_id]);
			
			return $this->render(
				'admin/show_elections.html.twig',
				[
					'elections'       => $elections,
					'controller_name' => 'AdminController',
				]
			);
		}
		
		/**
		 * @Route("/show_election/{election_id}", name="admin_show_election", methods={"GET","POST"}, requirements={"election_id"="\d+"})
		 * @param  int  $election_id
		 *
		 * @return Response
		 */
		public function show_election(int $election_id):Response
		{
			
			$election_id = $this->idManager('election', $election_id);
			
			return $this->render(
				'admin/show_election.html.twig',
				[
					'controller_name' => 'AdminController',
				]
			);
		}
		
		
		/**
		 * @Route("/edit_election/{election_id}", name="admin_edit_election", methods={"GET","POST"}, requirements={"election_id"="\d+"})
		 * @param  int  $election_id
		 *
		 * @return Response
		 */
		public function edit_election(int $election_id):Response
		{
			
			$election_id = $this->idManager('election', $election_id);
			
			return $this->render(
				'admin/edit_election.html.twig',
				[
					'controller_name' => 'AdminController',
				]
			);
		}
		
		/**
		 * @Route("/edit_race/{race_id}", name="admin_edit_race", methods={"GET","POST"}, requirements={"race_id"="\d+"})
		 * @param  int  $race_id
		 *
		 * @return Response
		 */
		public function edit_race(int $race_id):Response
		{
			$race_id = $this->idManager('race', $race_id);
			
			return $this->render(
				'admin/edit_race.html.twig',
				[
					'controller_name' => 'AdminController',
				]
			);
		}
		
		/**
		 * @Route("/finalize_race/{race_id}", name="admin_finalize_race", methods={"GET","POST"}, requirements={"race_id"="\d+"})
		 */
		public function finalize_race():Response
		{
			return $this->render(
				'admin/finalize_race.html.twig',
				[
					'controller_name' => 'AdminController',
				]
			);
		}
		
		/**
		 * @Route("/list_owners", name="admin_list_owners")
		 */
		public function list_owners():Response
		{
			return $this->render(
				'admin/list_owners.html.twig',
				[
					'controller_name' => 'AdminController',
				]
			);
		}
		
		/**
		 * @Route("/edit_owners", name="admin_edit_owners")
		 */
		public function edit_owners():Response
		{
			return $this->render(
				'admin/edit_owners.html.twig',
				[
					'controller_name' => 'AdminController',
				]
			);
		}
		
		
		/**
		 * @Route("/delete_owners", name="admin_delete_owners")
		 */
		public function delete_owners():Response
		{
			return $this->render(
				'admin/delete_owners.html.twig',
				[
					'controller_name' => 'AdminController',
				]
			);
		}
		
		/**
		 * @Route("/assume_user", name="admin_assume_user")
		 */
		public function assume_user():Response
		{
			return $this->render(
				'admin/assume_user.html.twig',
				[
					'controller_name' => 'AdminController',
				]
			);
		}
		
		
	}
