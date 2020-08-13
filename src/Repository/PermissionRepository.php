<?php
    
    namespace App\Repository;
    
    use App\Entity\Permission;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    
    /**
     * @method Permission|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method Permission|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method Permission[]    findAll()
     * @method Permission[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class PermissionRepository extends ServiceEntityRepository
    {
        
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        
        
        /**
         * PermissionRepository constructor.
         *
         * @param  RegistryInterface  $registry
         */
        public function __construct(RegistryInterface $registry)
        {
            parent::__construct($registry, Permission::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
        }
        
        
        /**
         * @param  int  $person_id
         * @param  int  $supervisor_id
         *
         * @param  int  $company_id
         * @param  int  $association_id
         * @param  int  $permission_id
         *
         * @return mixed
         *
         * @deprecated
         */
        public function addPermission(int $person_id, int $supervisor_id = NULL, int $company_id = NULL, int $association_id = NULL, int $permission_id = NULL)
        {
            $start  = ' INSERT INTO relationship(person_id';
            $middle = '
                ,created_at
                ,updated_at
                ,is_active
                ) VALUES ( '.$person_id.' ';
            $end    = '
                ,NOW()
                ,NOW()
                ,1)';
            
            $columns = '';
            $values  = '';
            
            if ($supervisor_id > 0) {
                $columns .= ', supervisor_id';
                $values  .= ' ,'.$supervisor_id;
            }
            
            if ($company_id > 0) {
                $columns .= ', company_id';
                $values  .= ' ,'.$company_id;
            }
            
            if ($association_id > 0) {
                $columns .= ', association_id';
                $values  .= ' ,'.$association_id;
            }
            
            if ($permission_id > 0) {
                $columns .= ', permission_id';
                $values  .= ' ,'.$permission_id;
            }
            
            $sql = $start.$columns.$middle.$values.$end;
            
            return $this->executeSQLStatement($sql);
        }
        
        
        
        
        // /**
        //  * @return Permission[] Returns an array of Permission objects
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
        public function findOneBySomeField($value): ?Permission
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
