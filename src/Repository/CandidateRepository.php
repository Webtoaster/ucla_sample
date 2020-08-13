<?php

	namespace App\Repository;

	use App\Entity\Candidate;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
	 * @method Candidate|null find($id, $lockMode = NULL, $lockVersion = NULL)
	 * @method Candidate|null findOneBy(array $criteria, array $orderBy = NULL)
	 * @method Candidate[]    findAll()
	 * @method Candidate[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
	 */
	class CandidateRepository extends ServiceEntityRepository
	{
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        

        
        /**
         * CandidateRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
		{
			parent::__construct($registry, Candidate::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
        }
        
        
        
        
        // /**
		//  * @return Candidate[] Returns an array of Candidate objects
		//  */
		/*
		public function findByExampleField($value)
		{
			return $this->createQueryBuilder('c')
				->andWhere('c.exampleField = :val')
				->setParameter('val', $value)
				->orderBy('c.id', 'ASC')
				->setMaxResults(10)
				->getQuery()
				->getResult()
			;
		}
		*/

		/*
		public function findOneBySomeField($value): ?Candidate
		{
			return $this->createQueryBuilder('c')
				->andWhere('c.exampleField = :val')
				->setParameter('val', $value)
				->getQuery()
				->getOneOrNullResult()
			;
		}
		*/
	}
