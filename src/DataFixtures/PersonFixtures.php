<?php

    namespace App\DataFixtures;

    use App\Entity\Person;
    use DateTime;
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Common\Persistence\ObjectManager;
    use Exception;
    use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

    /**
     * Class PersonFixtures
     *
     * @package App\DataFixtures
     */
    class PersonFixtures extends Fixture
    {

        private $encoder;

        /**
         * PersonFixtures constructor.
         *
         * @param  UserPasswordEncoderInterface  $encoder
         */
        public function __construct(UserPasswordEncoderInterface $encoder)
        {
            $this->encoder = $encoder;
        }

        /**
         * @param  ObjectManager  $manager
         *
         * @throws Exception
         */
        public function load(ObjectManager $manager):void
        {
            $person = new Person();

            $person->setEmail($_ENV['ADMIN_EMAIL']);
            $person->setPassword(
              $this->encoder->encodePassword(
                $person,
                $_ENV['ADMIN_PASSWORD']
              )
            );
    
            $person->setNameFormal($_ENV['ADMIN_NAME_DISPLAY']);
            $person->setNameFirst($_ENV['ADMIN_NAME_FIRST']);
            $person->setNameMiddle($_ENV['ADMIN_NAME_MIDDLE']);
            $person->setNameLast($_ENV['ADMIN_NAME_LAST']);

            $person->setMailingAddressLine1('1600 Pennsylvania Avenue');
            $person->setMailingAddressCity('Washington');
            $person->setMailingAddressState('DC');
            $person->setMailingAddressZipCode('22001');
            $person->setMailingAddressCountry('US');

            $person->setPhysicalAddressLine1('1600 Pennsylvania Avenue');
            $person->setPhysicalAddressCity('Washington');
            $person->setPhysicalAddressState('DC');
            $person->setPhysicalAddressZipCode('22001');

            $person->setPhoneHome($_ENV['ADMIN_PHONE_HOME']);
            $person->setPhoneMobile($_ENV['ADMIN_PHONE_MOBILE']);
            $person->setPhoneWork($_ENV['ADMIN_PHONE_WORK']);

            $person->setVerificationKey(md5(microtime()));
            $person->setVerificationDate(new DateTime());
            $person->setVerificationIpAddress('127.0.0.1');
            $person->setCreatedFromIp('127.0.0.1');
            $person->setUpdatedFromIp('127.0.0.1');

            $person->setTermsId(1);
            $person->setAgreedToTermsAt(new DateTime());

            $person->setIsActive(true);
            $person->setIsVerified(true);
            $person->setIsRegistered(true);
            $person->setHasStartedRegistration(true);

            $person->setRoles(
              [
                'ROLE_SUPER_ADMIN',
              ]
            );

            $manager->persist($person);
            $manager->flush();
        }

    }
