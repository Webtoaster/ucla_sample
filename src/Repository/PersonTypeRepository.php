<?php
    
    namespace App\Repository;
    
    use App\Entity\PersonType;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Doctrine\DBAL\DBALException;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    //	use Doctrine\ORM\EntityRepository;
    
    
    /**
     * Class PersonTypeRepository
     *
     * @package App\Repository
     *
     * @method PersonType|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method PersonType|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method PersonType[]    findAll()
     * @method PersonType[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     *
     */
    class PersonTypeRepository extends ServiceEntityRepository
    {
    
    
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
    
    
        /**
         * PersonTypeRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, PersonType::class);
    
            $this->conn = $this->getEntityManager()->getConnection();
    
            $this->logger = LoggerInterface::class;
        }
    
        /**
         * @return array
         */
        public function queryForPersonTypeForm():array
        {
            $sql = '
			 SELECT
				 person_type_id
				,description_long
			 FROM
				person_type
			 WHERE
			    is_active > 0
			 ';
    
            return $this->executeSQLQueryAndResults($sql);
        }
    
    
    
    
        // /**
        //  * @return PersonType[] Returns an array of PersonType objects
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
        public function findOneBySomeField($value): ?PersonType
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
         * @return PersonType[]
         *
         * @deprecated
         */
        public function XqueryForPersonTypeForm():array
        {
            $rs = $this->createQueryBuilder('person_type')
                       ->andWhere('person_type.isActive = 1')
                       ->orderBy('person_type.personTypeId', 'ASC')
                       ->getQuery()
                       ->execute()
            ;
        
            dd($rs);
        
            return $rs;
        }
        
        
    }
