<?php
	
	namespace App\Repository;
	
	use App\Entity\ImportStatus;
	use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
	use Doctrine\Common\Persistence\ManagerRegistry;
	
	/**
	 * @method ImportStatus|null find($id, $lockMode = NULL, $lockVersion = NULL)
	 * @method ImportStatus|null findOneBy(array $criteria, array $orderBy = NULL)
	 * @method ImportStatus[]    findAll()
	 * @method ImportStatus[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
	 */
	class ImportStatusRepository extends ServiceEntityRepository
	{
		public function __construct(ManagerRegistry $registry)
		{
			parent::__construct($registry, ImportStatus::class);
		}
		
		// /**
		//  * @return ImportStatus[] Returns an array of ImportStatus objects
		//  */
		/*
		public function findByExampleField($value)
		{
			return $this->createQueryBuilder('i')
				->andWhere('i.exampleField = :val')
				->setParameter('val', $value)
				->orderBy('i.id', 'ASC')
				->setMaxResults(10)
				->getQuery()
				->getResult()
			;
		}
		*/
		
		/*
		public function findOneBySomeField($value): ?ImportStatus
		{
			return $this->createQueryBuilder('i')
				->andWhere('i.exampleField = :val')
				->setParameter('val', $value)
				->getQuery()
				->getOneOrNullResult()
			;
		}
		*/
	}
