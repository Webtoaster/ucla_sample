<?php
	
	namespace App\Controller;
	
	use App\Entity\Person;
	use App\Form\PersonFormType;
	use App\Form\TermsOfServiceFormType;
	use App\Repository\PersonRepository;
	use App\Repository\RelationshipRepository;
	use App\Security\AppAuthenticator;
	use DateTime;
	use Exception;
	use Psr\Log\LoggerInterface;
	use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
	use Swift_Mailer;
	use Swift_Message;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
	use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
	
	/**
	 * Class RegistrationController
	 *
	 * @package App\Controller
	 * @Route("/registration")
	 * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
	 */
	class RegistrationController extends AbstractController
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
		 * @Route("/user/new/", name="signup_user", requirements={"supervisor_id"="\d+"})
		 * @param  Request                       $request
		 * @param  UserPasswordEncoderInterface  $passwordEncoder
		 * @param  GuardAuthenticatorHandler     $guardHandler
		 * @param  AppAuthenticator              $authenticator
		 * @param  PersonRepository              $personRepository
		 *
		 * @return Response
		 * @IsGranted("IS_AUTHENTICATED_ANONYMOUSLY")
		 * @throws Exception
		 */
		public function user(
			Request $request,
			UserPasswordEncoderInterface $passwordEncoder,
			GuardAuthenticatorHandler $guardHandler,
			AppAuthenticator $authenticator,
			PersonRepository $personRepository
		):Response
		{
			/**
			 * Remember, the object is User but the actual Entity is Person.
			 */
			$user = new Person();
			$form = $this->createForm(PersonFormType::class, $user);
			$form->remove('nameFormal');
			$form->handleRequest($request);
			
			if($form->isSubmitted() && $form->isValid()){
				/**
				 * Perform Database Maintenance.
				 * Deletes orphaned registrations which do not verify their account
				 * within an hour of starting it.  Set the HasStartedRegistration
				 * flag === TRUE to show the registrations has started.
				 */
				$personRepository->delete_orphaned_registrants();
				
				/**
				 * Set flags for self-registered account operations
				 */
				$user->setHasStartedRegistration(TRUE);
				$user->setIsActive(FALSE);
				$user->setIsRegistered(FALSE);
				$user->setIsVerified(FALSE);
				$user->setUn($user->getEmail());
				
				/**
				 * Encode the password
				 */
				$user->setPassword(
					$passwordEncoder->encodePassword(
						$user,
						$form->get('plainPassword')->getData()
					)
				);
				
				/**
				 * Perform the insert of the information.
				 */
				$entityManager = $this->getDoctrine()->getManager();
				$entityManager->persist($user);
				$entityManager->flush();
				
				/**
				 * Get the inserted user's ID.
				 */
				$newPersonId = $user->getId();
				
				/**
				 * Set Session Vars
				 */
				$this->session->clear();
				$this->session->set('HasStartedRegistration', TRUE);
				$this->session->set('person_id', $newPersonId);
				$this->session->set('applicant_id', $newPersonId);
				$this->session->set('email', $form->get('email')->getData());
				
				/**
				 * If you want to allow them to be logged in right after submitting an
				 * email address and a password, then set the environment variable == TRUE
				 * default is FALSE
				 */
				if($_ENV['AUTO_LOGIN_NEW_USER'] === TRUE){
					$guardHandler->authenticateUserAndHandleSuccess(
						$user,
						$request,
						$authenticator,
						'main'
					);
				}
				
				/**
				 * Set the flash message for the next page.
				 */
				$this->addFlash('success', 'New User Created.<br/>There are a couple more steps!');
				
				/**
				 * Redirect to next step.
				 */
				return $this->redirectToRoute('signup_terms_of_service');
			}
			
			return $this->render(
				'registration/registration_form_name_and_login.html.twig',
				[
					'form' => $form->createView(),
				]
			);
		}
		
		/**
		 * @Route("/terms_of_service", name="signup_terms_of_service")
		 * @param  Request           $request
		 * @param  PersonRepository  $personRepository
		 * @param  Swift_Mailer      $mailer
		 *
		 * @return Response
		 * @throws Exception
		 */
		public function terms_of_service(Request $request, PersonRepository $personRepository, Swift_Mailer $mailer):Response
		{
			/**
			 * Make sure they are in new user registration mode.
			 */
			if($this->session->has('HasStartedRegistration') === FALSE || $this->session->has('applicant_id') === FALSE){
				/**
				 * Set the error flash message for the next page.
				 */
				$this->addFlash('error', 'Please start your registration from the beginning.');
				$this->redirectToRoute('signup_user');
			}
			
			$person_id = $this->session->get('applicant_id');
			
			/**
			 * Get the user passed in to the URl Parameter "person_id"
			 */
			$em     = $this->getDoctrine()->getManager();
			$person = $personRepository->find($person_id);
			
			/**
			 * If there is not a person id association with the value passed, then toss them back to registration.
			 * TODO Setup an exclusions table to prevent abuse.
			 */
			if(!$person){
				$this->session->clear();
				$this->addFlash('error', 'There is not a user association with this user.');
				
				return $this->redirectToRoute('signup_user');
			}
			
			/**
			 * If they have been verified, then send them to home page.
			 */
			if($person->getIsVerified() === TRUE){
				return $this->redirectToRoute('app_home');
			}
			
			/**
			 * Remember, the object is User but the actual Entity is Person.
			 */
			$form = $this->createForm(TermsOfServiceFormType::class);
			$form->handleRequest($request);
			
			if($form->isSubmitted() && $form->isValid() && $form['agreeTerms']->getData() === TRUE){
				/**
				 *  Make a verification key with just MD5 for now and then insert it into the database.
				 */
				$verification_key = $this->makeVerificationKey($person->getEmail());
				$person->setVerificationKey($verification_key);
				
				/**
				 * Stuff it into an array and then stuff it into a session and pass it on into the email
				 * to be sent later.
				 */
				$url_key = $this->generateUrl(
					'signup_email_verification_key',
					[
						'key' => $verification_key,
					],
					0
				);
				$person->setAgreedToTermsAt(new DateTime());
				$em->persist($person);
				$em->flush();
				
				/**
				 * Send Email Message
				 */
				$message = new Swift_Message();
				$message->setSubject($_ENV['VERIFICATION_EMAIL_SUBJECT'])
				        ->setSender($_ENV['FROM_EMAIL_ADDRESS'], $_ENV['FROM_EMAIL_NAME'])
				        ->setFrom(
					        [
						        $_ENV['FROM_EMAIL_ADDRESS'] => $_ENV['FROM_EMAIL_NAME'],
					        ]
				        )
				        ->setTo(
					        [
						        $person->getEmail() => $person->getNameFormal(),
					        ]
				        )
				        ->setSender($_ENV['FROM_EMAIL_ADDRESS'], $_ENV['FROM_EMAIL_NAME'])
				        ->setBody(
					        $this->renderView(
						        'blocks/email/_message_email_verification.html.twig',
						        [
							        'first_name'       => $person->getNameFirst(),
							        'to_display_name'  => $person->getNameFormal(),
							        'to_email_address' => $person->getEmail(),
							        'url_key'          => $url_key,
						        ]
					        ),
					        'text/html',
					        'UTF-8'
				        )
				;
				$mailer->send($message);
				$this->addFlash('success', 'Email Message is Sent.');
				
				/**
				 * Return to the user the Email is Sent message.
				 */
				return $this->render(
					'registration/email_verification_is_sent.html.twig',
					[
						'first_name'    => $person->getNameFirst(),
						'email_address' => $person->getEmail(),
					]
				);
			}
			
			return $this->render(
				'registration/registration_form_terms_of_service.html.twig',
				[
					'form' => $form->createView(),
				]
			);
		}
		
		/**
		 *  Make a URL Key for the Email Verification.
		 *
		 * @param  string  $email_address
		 *
		 * @return string
		 */
		private function makeVerificationKey(string $email_address):string
		{
			return md5($_ENV['APP_SECRET'] . $email_address);
		}
		
		/**
		 * This is the URL in the verification email which the user receives.
		 * @Route("/email_verification/{key}", name="signup_email_verification_key")
		 *
		 * @param  Request                    $request
		 * @param  string                     $key
		 * @param  GuardAuthenticatorHandler  $guardHandler
		 * @param  AppAuthenticator           $authenticator
		 * @param  PersonRepository           $personRepository
		 * @param  RelationshipRepository     $relationshipRepository
		 *
		 * @return Response
		 * @throws Exception
		 */
		public function email_verification_key(
			Request $request,
			string $key,
			GuardAuthenticatorHandler $guardHandler,
			AppAuthenticator $authenticator,
			PersonRepository $personRepository,
			RelationshipRepository $relationshipRepository
		):Response
		{
			/**
			 * Perform Database Maintenance.
			 * Deletes orphaned registrations which do not verify their account
			 * within an hour of starting it.  Set the HasStartedRegistration
			 * flag === TRUE to show the registrations has started.
			 */
			$personRepository->delete_orphaned_registrants();
			
			/**
			 * Clear out whatever session vars they have in place.
			 */
			$this->session->clear();
			
			/**
			 * Get the user passed in to the URl Parameter "person_id"
			 */
			$person = $personRepository->findOneBy(['verificationKey' => $key]);
			
			/**
			 * If there is not a person id association with the value passed, then toss them back to registration.
			 * TODO Setup an exclusions table to prevent abuse.
			 */
			if(!$person){
				$this->session->clear();
				$this->addFlash('error', 'The key is incorrect.  It does not exist in our database.  Please restart your sign up.');
				
				return $this->redirectToRoute('signup_email_resend');
			}
			
			/**
			 * If the user is new to the system, then add them to the relationships table.
			 */
			$relationshipRepository->addUserToSelf($person->getId());
			
			/**
			 * If this user has already verified this email address, Stop Now.
			 * Send give them the template that already shows them the verification is
			 * completed for this email address.
			 */
			if($person->getIsVerified() === TRUE){
				return $this->render('registration/email_verification_is_already_completed.html.twig');
			}
			
			/**
			 * Perform the updates where the user's email verification is performed.
			 * Get IP Address for the update to the database.
			 */
			$em = $this->getDoctrine()->getManager();
			$ip = $request->getClientIp();
			$this->session->set('person_id', $person->getId());
			$person->setVerificationDate(new DateTime());
			$person->setRoles(['ROLE_USER']);
			$person->setVerificationIpAddress($ip);
			$person->setIsActive(TRUE);
			$person->setIsRegistered(TRUE);
			$person->setIsVerified(TRUE);
			$em->persist($person);
			$em->flush();
			
			/**
			 * hand the request over to Guard Authenticator.
			 */
			return $guardHandler->authenticateUserAndHandleSuccess(
				$person,
				$request,
				$authenticator,
				'main'
			);
		}
		
		/**
		 * @Route("/email_verification_completed", name="signup_email_verification_completed")
		 * @return Response
		 * @throws Exception
		 */
		public function email_verification_completed():Response
		{
			return $this->render('registration/email_verification_is_successful.html.twig');
		}
		
		/**
		 * TODO Complete this method.
		 * @Route("/email_resend", name="signup_email_resend")
		 *
		 * @param  Request                       $request
		 * @param  UserPasswordEncoderInterface  $passwordEncoder
		 * @param  GuardAuthenticatorHandler     $guardHandler
		 * @param  AppAuthenticator              $authenticator
		 *
		 * @return Response
		 * @throws Exception
		 */
		public function email_resend(
			Request $request,
			UserPasswordEncoderInterface $passwordEncoder,
			GuardAuthenticatorHandler $guardHandler,
			AppAuthenticator $authenticator
		):Response
		{
			return $this->render(
				'base.html.twig',
				[
					//	'form' => $form->createView(),
				]
			);
		}
		
		
	}
