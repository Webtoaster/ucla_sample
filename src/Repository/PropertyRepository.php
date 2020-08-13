<?php

	namespace App\Repository;

	use App\Entity\Property;
	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Doctrine\DBAL\DBALException;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;

	/**
	 * @method Property|null find($id, $lockMode = NULL, $lockVersion = NULL)
	 * @method Property|null findOneBy(array $criteria, array $orderBy = NULL)
	 * @method Property[]    findAll()
	 * @method Property[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
	 */
	class PropertyRepository extends ServiceEntityRepository
	{
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        

        
        
        /**
         * PropertyRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
		{
			parent::__construct($registry, Property::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
        }
        
        
        
        // /**
		//  * @return Property[] Returns an array of Property objects
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
		public function findOneBySomeField($value): ?Property
		{
			return $this->createQueryBuilder('p')
				->andWhere('p.exampleField = :val')
				->setParameter('val', $value)
				->getQuery()
				->getOneOrNullResult()
			;
		}
		*/
	}
