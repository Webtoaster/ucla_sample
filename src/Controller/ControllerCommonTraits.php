<?php
	
	namespace App\Controller;
	
	use App\Entity\Person;
	use App\Repository\RelationshipRepository;
	use Psr\Log\LoggerInterface;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	
	/**
	 * Trait ControllerCommonTraits
	 *
	 * @package App\Controller
	 */
	trait ControllerCommonTraits
	{
		
		
		/**
		 * @var LoggerInterface
		 */
		private $logger;
		
		/**
		 * @var SessionInterface
		 */
		private $session;
		
		
		/**
		 * Manage the setting of Session Vars and getting them on Primary Key elements in the controllers.
		 *
		 * @param  string  $var    Lowercase string representing the entity.
		 * @param  int     $value  Primary key of the entity.
		 *
		 * @return int
		 */
		private function idManager(string $var, int $value):int
		{
			
			
			// Pull the "_id" off the end of the $var.
			$var         = str_replace('_id', '', $var);
			$currentName = 'current_' . $var . '_id';
			
			//  There is a positive integer submitted to the method, so assign that into a session
			//  var and return that value
			if($value > 0){
				$this->session->set($currentName, $value);
				
				return $value;
			}
			
			//  Get the current ID from the session var, test and return it.
			$id = (int)$this->session->get($currentName, 0);
			if($id > 0){
				$this->session->set($currentName, $value);
				
				return $id;
			}
			
			//  TODO throw error/exception here.
			//  Return zero even though this is not desirable.
			return 0;
		}
		
		
		/**
		 * Deterministic if a user is allowed to complete a task or not.
		 *
		 * @param  string  $action
		 * @param  string  $entity
		 * @param  array   $otherVars
		 *
		 * @return bool
		 */
		private function CanUserPerformTask(string $action, string $entity, array $otherVars = []):bool
		{
			$user_id = $this->getUser()->getId();
			
			$personRepository = $this->getDoctrine()->getRepository(Person::class);
			
			$relationshipRepository = $this->getDoctrine()->getRepository(RelationshipRepository::class);
			
			$personTypeId = $personRepository->getPersonTypeByUserId($user_id);
			
			$allowedActions = [
				'create',
				'read',
				'update',
				'delete',
				'suspend',
			];
		}
		
		
	}
