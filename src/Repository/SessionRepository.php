<?php

	namespace App\Repository;

	use App\Entity\Sessions;
	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;

	/**
	 * @method Sessions|null find($id, $lockMode = NULL, $lockVersion = NULL)
	 * @method Sessions|null findOneBy(array $criteria, array $orderBy = NULL)
	 * @method Sessions[]    findAll()
	 * @method Sessions[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
	 */
	class SessionRepository extends ServiceEntityRepository
	{
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        

        
        /**
         * SessionRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
		{
			parent::__construct($registry, Sessions::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
        }

		// /**
		//  * @return Sessions[] Returns an array of Sessions objects
		//  */
		/*
		public function findByExampleField($value)
		{
			return $this->createQueryBuilder('s')
				->andWhere('s.exampleField = :val')
				->setParameter('val', $value)
				->orderBy('s.id', 'ASC')
				->setMaxResults(10)
				->getQuery()
				->getResult()
			;
		}
		*/

		/*
		public function findOneBySomeField($value): ?Sessions
		{
			return $this->createQueryBuilder('s')
				->andWhere('s.exampleField = :val')
				->setParameter('val', $value)
				->getQuery()
				->getOneOrNullResult()
			;
		}
		*/
	}
