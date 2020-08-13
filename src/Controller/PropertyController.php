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
	 * Class PropertyController
	 *
	 * @package App\Controller
	 * @Route("/property")
	 * @IsGranted("ROLE_USER")
	 */
	class PropertyController extends AbstractController
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
		 * @Route("/dashboard/{association_id}", name="property_control_panel")
		 * @param  int  $association_id
		 *
		 * @return Response
		 */
		public function control_panel(int $association_id):Response
		{
			
			
			$association_id = $this->idManager('association', $association_id);
			
			return $this->render(
				'property/control_panel.html.twig',
				[
					'controller_name' => 'propertyController',
				]
			);
		}
		
		
		/**
		 * @Route("/new{association_id}", name="property_new")
		 * @IsGranted("ROLE_PROPERTY_CREATE")
		 * @param  int      $association_id
		 * @param  Request  $request
		 *
		 * @return Response
		 */
		public function create(int $association_id, Request $request):Response
		{
			
			$association_id = $this->idManager('association', $association_id);
			
			return $this->render(
				'property/create.html.twig',
				[
					'controller_name' => 'propertyController',
				]
			);
		}
		
		/**
		 * @Route("/update/{property_id}", name="property_update")
		 * @param  int  $property_id
		 *
		 * @return Response
		 */
		public function update(int $property_id):Response
		{
			
			$property_id = $this->idManager('property', $property_id);
			
			return $this->render(
				'property/update.html.twig',
				[
					'controller_name' => 'propertyController',
				]
			);
		}
		
		/**
		 * @Route("/delete/{property_id}", name="property_delete")
		 * @param  int  $property_id
		 *
		 * @return Response
		 */
		public function delete(int $property_id):Response
		{
			$property_id = $this->idManager('property', $property_id);
			
			return $this->render(
				'property/delete.html.twig',
				[
					'controller_name' => 'propertyController',
				]
			);
		}
		
		/**
		 * @Route("/denied_access", name="property_denied_access")
		 */
		public function denied_access():Response
		{
			return $this->render(
				'property/denied_access.html.twig',
				[
					'controller_name' => 'propertyController',
				]
			);
		}
		
		
	}
