<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\BooleanIsActiveTrait;
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\Common\Collections\Collection;
    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;

    /**
     * Upload
     * @ORM\Table(name="upload")
     * @ORM\HasLifecycleCallbacks()
     * @ORM\Entity(
     *     repositoryClass="App\Repository\UploadRepository",
     * )
     */
    class Upload
    {
	
	
	    /**
         * @var int
         * @ORM\Column(
         *     name="upload_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for uploaded file"}
         *     )
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $uploadId;
	
	
	    /**
	     * @ORM\ManyToOne(
	     *     targetEntity="Company"
	     * )
	     * @ORM\JoinColumn(
	     *     name="company_id",
	     *     referencedColumnName="company_id",
	     *     nullable=true,
	     *     onDelete="SET NULL"
	     * )
	     */
	    private $company;
	
	    /**
	     * @ORM\ManyToOne(
	     *     targetEntity="Company"
	     * )
	     * @ORM\JoinColumn(
	     *     name="association_id",
	     *     referencedColumnName="company_id",
	     *     nullable=true,
	     *     onDelete="SET NULL"
	     * )
	     */
	    private $association;
	
	
	    /**
         * @ORM\Column(
	     *     name="original_uploaded_file_name",
         *     type="string",
	     *     nullable=true,
	     *     length=255,
	     *     options={"fixed"=true, "comment"="Example: uploaded_test.xlsx"}
	     * )
         */
	    private $originalUploadedFileName;
        
        
        /**
         * @ORM\Column(
         *     name="new_file_name",
         *     type="string",
         *     nullable=true,
         *     length=255,
         *     options={"fixed"=true, "comment"="Example: uploaded-test-2019-09-12_07-18-28.xlsx"}
         * )
         */
	    private $newFileName;
        
        
        /**
         * @ORM\Column(
         *     name="mime_type",
         *     type="string",
         *     nullable=true,
         *     length=255,
         *     options={"fixed"=true, "comment"="Example: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"}
         * )
         */
	    private $mimeType;
        
        
        /**
         * @ORM\Column(
         *     name="guessed_file_extension",
         *     type="string",
         *     nullable=true,
         *     length=255,
         *     options={"fixed"=true, "comment"="Example: xlsx"}
         * )
         */
	    private $guessedFileExtension;
        
        
        /**
         * @ORM\Column(
         *     name="absolute_file_path",
         *     type="string",
         *     nullable=true,
         *     length=255,
         *     options={"fixed"=true, "comment"="Example: /shared/httpd/community-election/public/uploads/12/uploaded-test-2019-09-12_07-18-28.xlsx"}
         * )
         */
	    private $absoluteFilePath;
        
        /**
         * @ORM\Column(
         *     name="web_path",
         *     type="string",
         *     nullable=true,
         *     length=255,
         *     options={"fixed"=true, "comment"="Example: public/uploads/12/uploaded-test-2019-09-12_07-18-28.xlsx"}
         * )
         */
	    private $webPath;

        /**
         * @ORM\OneToMany(
         *     targetEntity="Import",
         *     mappedBy="upload",
         *     orphanRemoval=true
         * )
         */
	    private $imports;
        
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
	
	
	    public function __construct()
        {
	        $this->imports = new ArrayCollection();
        }
	
	
	    /**
	     * @return string
	     */
	    public function __toString()
	    {
		    return $this->getNewFileName();
	    }
	
	
	    /**
	     * @return int
	     */
	    public function getId():int
	    {
		    return $this->uploadId;
	    }
	
	
	    /**
	     * @return int
	     */
	    public function getUploadId():int
        {
            return $this->uploadId;
        }
	
	
	    /**
	     * @return string|null
	     */
	    public function getOriginalUploadedFileName():?string
	    {
		    return $this->originalUploadedFileName;
	    }
	
	    /**
	     * @param  string|null  $originalUploadedFileName
	     *
	     * @return $this
	     */
	    public function setOriginalUploadedFileName(?string $originalUploadedFileName):self
	    {
		    $this->originalUploadedFileName = $originalUploadedFileName;
		
		    return $this;
	    }
	
	
	    /**
	     * @return null|string
	     */
	    public function getNewFileName():?string
	    {
		    return $this->newFileName;
	    }
	
	    /**
	     * @param  string|null  $newFileName
	     *
	     * @return $this
	     */
	    public function setNewFileName(?string $newFileName):self
	    {
		    $this->newFileName = $newFileName;
		
		    return $this;
	    }
	
	    /**
	     * @return string|null
	     */
	    public function getMimeType():?string
        {
	        return $this->mimeType;
        }
	
	    /**
	     * @param  string|null  $mimeType
	     *
	     * @return $this
	     */
	    public function setMimeType(?string $mimeType):self
        {
	        $this->mimeType = $mimeType;
            
            return $this;
        }
	
	    /**
	     * @return string|null
	     */
	    public function getGuessedFileExtension():?string
        {
	        return $this->guessedFileExtension;
        }
	
	    /**
	     * @param  string|null  $guessedFileExtension
	     *
	     * @return $this
	     */
	    public function setGuessedFileExtension(?string $guessedFileExtension):self
        {
	        $this->guessedFileExtension = $guessedFileExtension;
            
            return $this;
        }
	
	    /**
	     * @return string|null
	     */
	    public function getAbsoluteFilePath():?string
        {
	        return $this->absoluteFilePath;
        }
	
	    /**
	     * @param  string|null  $absoluteFilePath
	     *
	     * @return $this
	     */
	    public function setAbsoluteFilePath(?string $absoluteFilePath):self
        {
	        $this->absoluteFilePath = $absoluteFilePath;
            
            return $this;
        }
	
	    /**
	     * @return string|null
	     */
	    public function getWebPath():?string
        {
	        return $this->webPath;
        }
	
	    /**
	     * @param  string|null  $webPath
	     *
	     * @return $this
	     */
	    public function setWebPath(?string $webPath):self
        {
	        $this->webPath = $webPath;
            
            return $this;
        }
	
	    /**
	     * @return Company|null
	     */
	    public function getCompany():?Company
        {
	        return $this->company;
        }
	
	    /**
	     * @param  Company|null  $company
	     *
	     * @return $this
	     */
	    public function setCompany(?Company $company):self
        {
	        $this->company = $company;
            
            return $this;
        }
	
	    /**
	     * @return Company|null
	     */
	    public function getAssociation():?Company
        {
	        return $this->association;
        }
	
	    /**
	     * @param  Company|null  $association
	     *
	     * @return $this
	     */
	    public function setAssociation(?Company $association):self
        {
	        $this->association = $association;
            
            return $this;
        }

        /**
         * @return Collection|Import[]
         */
	    public function getImports():Collection
        {
	        return $this->imports;
        }
	
	    /**
	     * @param  Import  $import
	     *
	     * @return $this
	     */
	    public function addImport(Import $import):self
        {
	        if(!$this->imports->contains($import)){
		        $this->imports[] = $import;
		        $import->setUpload($this);
	        }

            return $this;
        }
	
	    /**
	     * @param  Import  $import
	     *
	     * @return $this
	     */
	    public function removeImport(Import $import):self
        {
	        if($this->imports->contains($import)){
		        $this->imports->removeElement($import);
		        // set the owning side to null (unless already changed)
		        if($import->getUpload() === $this){
			        $import->setUpload(NULL);
		        }
	        }

            return $this;
        }
	
	
    }
