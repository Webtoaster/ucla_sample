<?php
    
    namespace App\Repository;
    
    use App\Entity\Upload;
    use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
    use Psr\Log\LoggerInterface;
    use Symfony\Bridge\Doctrine\RegistryInterface;
    use Symfony\Component\HttpFoundation\RequestStack;
    
    /**
     * @method Upload|null find($id, $lockMode = NULL, $lockVersion = NULL)
     * @method Upload|null findOneBy(array $criteria, array $orderBy = NULL)
     * @method Upload[]    findAll()
     * @method Upload[]    findBy(array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL)
     */
    class UploadRepository extends ServiceEntityRepository
    {
        
        
        use RepositoryCommonTraits;
        
        use SQLQueriesTrait;
        
        
        /**
         * UploadRepository constructor.
         *
         * @param  RegistryInterface  $registry
         * @param  RequestStack       $requestStack
         */
	    public function __construct(RegistryInterface $registry, RequestStack $requestStack)
        {
            parent::__construct($registry, Upload::class);
            
            $this->conn = $this->getEntityManager()->getConnection();
            
            $this->logger = LoggerInterface::class;
	
	        $this->conn = $this->getEntityManager()->getConnection();
	
	        $this->logger = LoggerInterface::class;
	
	        $this->requestStack = $requestStack;
	
	        $request = $this->requestStack->getCurrentRequest();
	
	        $ip = $request->getClientIp();
	
	        if(filter_var($ip, FILTER_VALIDATE_IP)){
		        $this->clientIp = $ip;
	        }
	        else {
		        $this->clientIp = '';
	        }
	
	        unset($request);
        }
	
	
	    /**
	     * Add an uploaded file into the uploads table.
	     *
	     * @param  int     $association_id
	     * @param  string  $original_uploaded_file_name
	     * @param  string  $new_file_name
	     * @param  string  $mime_type
	     * @param  string  $guessed_file_extension
	     * @param  string  $absolute_file_path
	     * @param  string  $web_path
	     *
	     * @return int
	     */
	    public function addUploadedDataFile(
		    int $association_id,
		    string $original_uploaded_file_name,
		    string $new_file_name,
		    string $mime_type,
		    string $guessed_file_extension,
		    string $absolute_file_path,
		    string $web_path
	    ):int
	    {
		
		    $company_id = $this->selectParentCompanyByAssociationId($association_id);
		
		    return $this->insertIntoUpload(
			    $company_id,
			    $association_id,
			    $original_uploaded_file_name,
			    $new_file_name,
			    $mime_type,
			    $guessed_file_extension,
			    $absolute_file_path,
			    $web_path
		    );
	    }
        
        
        
        
        // /**
        //  * @return Upload[] Returns an array of Upload objects
        //  */
        /*
        public function findByExampleField($value)
        {
            return $this->createQueryBuilder('u')
                ->andWhere('u.exampleField = :val')
                ->setParameter('val', $value)
                ->orderBy('u.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
        }
        */
        
        /*
        public function findOneBySomeField($value): ?Upload
        {
            return $this->createQueryBuilder('u')
                ->andWhere('u.exampleField = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }
        */
    }
