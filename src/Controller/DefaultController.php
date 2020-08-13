<?php
	
	namespace App\Controller;
	
	use App\Entity\Person;
	use App\Repository\CompanyRepository;
	use App\Repository\PersonRepository;
	use App\Repository\RelationshipRepository;
	use DateTime;
	use Exception;
	use Psr\Log\LoggerInterface;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
	
	/**
	 * Class DefaultController
	 *
	 * @package App\Controller
	 */
	class DefaultController extends AbstractController
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
		 * @Route("/", name="app_home")
		 * @param  RelationshipRepository  $repository
		 *
		 * @return Response
		 */
		public function index(RelationshipRepository $repository):Response
		{
			
			
			$company_id = $this->idManager('company', 1);
			
			
		
		
			// $company_id = $repository->findPrimaryCompanyIdByUserId($this->getUser()->getId());
			//
			// //	dd($company_id);
			//
			// $company_id = $this->idManager('company', $company_id);
			//
			// $association_id = $this->idManager('association', $company_id);
			
			return $this->render(
				'default/index.html.twig',
				[
					'company_id'      => $company_id,
					// 'association_id'  => $association_id,
					'controller_name' => 'DefaultController',
				
				]
			);
		}
		
		
		/**
		 * @Route("/test", name="app_test")
		 * @return Response
		 */
		public function test(RelationshipRepository $relRepo, CompanyRepository $coRepo):Response
		{
			
			
			
			$user_id = $this->getUser()->getId();
			
			dump($user_id);
			
			
			
			
			//  Assign into a session all associations and companies this user is associated.
			
			$company_ids = $relRepo->findAllAssociationIdsByUserId($user_id);
			
			
			dd($company_ids);
	
			
			return NULL;
		}
		
		
		/**
		 * @Route("/testquery", name="app_testquery")
		 * @param  Request                       $request
		 * @param  PersonRepository              $repository
		 * @param  UserPasswordEncoderInterface  $passwordEncoder
		 *
		 * @return Response
		 * @throws Exception
		 */
		public function testQuery(Request $request, PersonRepository $repository, UserPasswordEncoderInterface $passwordEncoder):Response
		{
			$entityManager = $this->getDoctrine()->getManager();
			
			$rs = $repository->loadUserData();
			
			//    dd($rs);
			
			foreach($rs as $r) {
				// $person = Person::class;
				
				$person = new Person();
				
				$person->setEmail($r['email']);
				
				// dump($r['pw']);
				
				$person->setPassword(
					$passwordEncoder->encodePassword(
						$person,
						$r['pw']
					)
				);
				
				//
				// $person->setPassword(
				//     $encoder->encodePassword(
				//         $person,
				//         $r['pw']
				//     )
				// );
				$person->setNameFormal($r['name_formal']);
				$person->setNameFirst($r['name_first']);
				$person->setNameMiddle($r['name_middle']);
				$person->setNameLast($r['name_last']);
				$person->setMailingAddressLine1($r['mailing_address_line1']);
				$person->setMailingAddressCity($r['mailing_address_city']);
				$person->setMailingAddressState($r['mailing_address_state']);
				$person->setMailingAddressZipCode($r['mailing_address_zip_code']);
				$person->setMailingAddressCountry($r['mailing_address_country']);
				$person->setPhysicalAddressLine1($r['physical_address_line1']);
				$person->setPhysicalAddressCity($r['physical_address_city']);
				$person->setPhysicalAddressState($r['physical_address_state']);
				$person->setPhysicalAddressZipCode($r['physical_address_zip_code']);
				$person->setPhoneHome($r['phone_home']);
				$person->setPhoneMobile($r['phone_mobile']);
				$person->setPhoneWork($r['phone_work']);
				$person->setVerificationKey(md5(microtime()));
				$person->setVerificationDate(new DateTime());
				$person->setVerificationIpAddress('127.0.0.1');
				$person->setCreatedFromIp('127.0.0.1');
				$person->setUpdatedFromIp('127.0.0.1');
				$person->setTermsId(1);
				$person->setAgreedToTermsAt(new DateTime());
				$person->setIsActive(TRUE);
				$person->setIsVerified(TRUE);
				$person->setIsRegistered(TRUE);
				$person->setHasStartedRegistration(TRUE);
				$person->setRoles(['ROLE_USER']);
				
				$entityManager->persist($person);
				$entityManager->flush();
				
				dump($person);
			}
			
			//  dd($this->getUser()->getId());
			
			//        dd($rs);
			
			//  dd($relRepo->findPrimaryCompanyAndAllAssociationsByUserId($this->getUser()->getId()));
			
			// $rs = $rel->findBy(['company' => $this->getUser()]);
			//
			// dd($rs);
			
			//  $rs = $relationship->queryAllRelatedCompaniesToUser($this->getUser());
			
			//            dd($this->getUser()->getId());
			return $this->render(
				'default/index.html.twig',
				[
					'controller_name' => 'DefaultController',
				]
			);
		}
		
		
	}
