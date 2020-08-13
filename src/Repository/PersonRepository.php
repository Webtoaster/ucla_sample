<?php
    
    namespace App\Repository;
    
    use App\Entity\Person;
    use DateTime;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Doctrine\ORM\OptimisticLockException;
    use Doctrine\ORM\ORMException;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
    
    /**
     * Class PersonRepository
     *
     * @package App\Repository
     */
    class PersonRepository extends ServiceEntityRepository
    {
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        
        private $passwordEncoder;
        
        
        /**
         * PersonRepository constructor.
         *
         * @param  RegistryInterface             $registry
         * @param  UserPasswordEncoderInterface  $passwordEncoder
         */
        public function __construct(RegistryInterface $registry, UserPasswordEncoderInterface $passwordEncoder)
        {
            parent::__construct($registry, Person::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
            
            $this->passwordEncoder = $passwordEncoder;
        }
        
        
        /**
         * This will remove orphaned contacts which were not verified after XXX amount of time.
         * The setting for the amount of time is set in the ENV settings.
         *
         * @author Tom Olson <olson@webtoaster.com>
         *
         * @return bool
         */
        public function delete_orphaned_registrants():bool
        {
            $sql = '';
            
            /**
             * You may need to add this to the SQL code in case your SQL server has a problem
             * with TimeZones not being set.
             * $sql .= 'SET time_zone = \''.$_ENV['MYSQL_TIME_ZONE'].'\';';
             */
            $sql .= '
                DELETE FROM	person
				WHERE
				      person.has_started_registration = 1 AND
					  person.is_verified = 0 AND
					  person.created_at < CURRENT_TIMESTAMP - INTERVAL '.$_ENV['ELAPSED_TIME_ORPHANED_REGISTRANT'].' SECOND ';
    
            return $this->executeSQLDelete($sql);
        }
        
        /**
         * @param $email
         *
         * @return int
         */
        public function getPersonTypeByEmail($email):int
        {
            $sql    = '
                SELECT
                    person_type_id
                FROM
                    person
                WHERE
                    email = :email
            ';
            $params = compact('email');
            $rs     = $this->executeSQLQueryAndSingleRowResults($sql, $params);
            
            return (int)$rs['person_type_id'];
        }
        
        /**
         * @param  int  $person_id
         *
         * @return int
         */
        public function getPersonTypeByUserId(int $person_id):int
        {
            $sql = '
                SELECT
                    person_type_id
                FROM
                    person
                WHERE
                    id = :person_id
            ';
    
            $params = compact('person_id');
            $rs     = $this->executeSQLQueryAndSingleRowResults($sql, $params);
            
            return (int)$rs['person_type_id'];
        }
    
    
    
    
        // /**
        //  * @return Person[] Returns an array of Person objects
        //  */
        /*
        public function findByExampleField($value)
        {
            return $this->createQueryBuilder('p')
                ->andWhere('p.exampleField = :val')
                ->setParameter('val', $value)
                ->orderBy('p.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
        }
        */
        /*
        public function findOneBySomeField($value): ?Person
        {
            return $this->createQueryBuilder('p')
                ->andWhere('p.exampleField = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }
        */
        
        /**
         * @throws ORMException
         * @throws OptimisticLockException
         * @return array
         */
        public function loadUserData():array
        {
            $sql = '
                    SELECT
                     person_type_id
                    ,pw
                    ,password_recovery_key
                    ,password_recovery_date
                    ,password_recovery_ip_address
                    ,roles
                    ,verification_key
                    ,verification_date
                    ,verification_ip_address
                    ,has_started_registration
                    ,is_verified
                    ,is_registered
                    ,agreed_to_terms_at
                    ,terms_id
                    ,name_formal
                    ,name_first
                    ,name_middle
                    ,name_last
                    ,name_suffix
                    ,mailing_address_line1
                    ,mailing_address_line2
                    ,mailing_address_city
                    ,mailing_address_state
                    ,mailing_address_zip_code
                    ,mailing_address_country
                    ,physical_address_line1
                    ,physical_address_line2
                    ,physical_address_city
                    ,physical_address_state
                    ,physical_address_zip_code
                    ,email
                    ,un
                    ,phone_home
                    ,phone_work
                    ,phone_mobile
                    ,phone_fax
                    ,created_from_ip
                    ,updated_from_ip
                    ,created_at
                    ,updated_at
                    ,is_active
                    FROM
                     skeleton.person_temp;
                     
                     
            ';
            
            $rs = $this->executeSQLQueryAndResults($sql);
            
            return $rs;
            
            // dd($rs);
            
            $manager = $this->getEntityManager();
            
            foreach ($rs as $r) {
                $person = Person::class;
                
                $person->setEmail($r['email']);
                
                dump($r['pw']);
                
                $person->setPassword(
                    $this->passwordEncoder->encodePassword(
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
                $person->setRoles($r['roles']);
                
                $manager->persist($person);
                $manager->flush();
            }
        }
        
        
    }
