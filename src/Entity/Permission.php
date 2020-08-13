<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\BooleanIsActiveTrait;
    use App\Entity\Common\DescriptionTrait;
    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;
    use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
    
    /**
     * @package App\Entity
     *
     * Class Permission
     *
     * @ORM\Table(
     *     name="permission",
     *     indexes={
     *        @ORM\Index(name="idx_permission_description", columns={"description_short"})
     *     }
     * )
     *
     * @ORM\Entity(
     *     repositoryClass="App\Repository\PermissionRepository"
     * )
     *
     * @UniqueEntity(
     *     fields={"description_short"},
     *     message="There is already a Permission with this Description."
     * )
     */
    class Permission
    {
    
        /**
         * @var int $permissionId
         *
         * @ORM\Column(
         *     name="permission_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for Permission"}
         *     )
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $permissionId;
    
    
        /**
         * @var string|null $role
         *
         * @ORM\Column(
         *     name="role",
         *     type="string",
         *     length=255,
         *     nullable=true,
         *     options={"fixed"=true, "comment"="For Role Hierarchy in the Security.yml file."}
         * )
         */
        private $role;
    
        /**
         * @var string|null $roles
         *
         * @ORM\Column(
         *     name="roles",
         *     type="json",
         *     length=0,
         *     nullable=true
         * )
         */
        private $roles = [];
        
        
        /**
         * @var bool $canCreate
         *
         * @ORM\Column(
         *     name="can_create",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=0, "comment"="Can User Create a Record"}
         *     )
         */
        private $canCreate = FALSE;
    
    
        /**
         * @var bool $canView
         *
         * @ORM\Column(
         *     name="can_view",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=0, "comment"="Can User View a Record"}
         *     )
         */
        private $canView = FALSE;
    
    
        /**
         * @var bool $canUpdate
         *
         * @ORM\Column(
         *     name="can_update",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=0, "comment"="Can User Update a Record"}
         *     )
         */
        private $canUpdate = FALSE;
    
        /**
         * @var bool $canDelete
         *
         * @ORM\Column(
         *     name="can_delete",
         *     type="boolean",
         *     nullable=false,
         *     options={"default"=0, "comment"="Can User Delete a Record"}
         *     )
         */
        private $canDelete = FALSE;
    
    
        /**
         * @var string|null $category
         *
         * @ORM\Column(
         *     name="category",
         *     type="string",
         *     length=255,
         *     nullable=true,
         *     options={"fixed"=true, "comment"="Category of the Permission Group"}
         * )
         */
        private $category;
    
        /**
         * @var string|null $subcategory
         *
         * @ORM\Column(
         *     name="subcategory",
         *     type="string",
         *     length=255,
         *     nullable=true,
         *     options={"fixed"=true, "comment"="SubCategory of the Permission Group"}
         * )
         */
        private $subcategory;
    
    
        use DescriptionTrait;
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
	
	    /**
	     * @return string
	     */
	    public function __toString():string
	    {
		    return $this->getDescriptionShort();
	    }
	
	    /**
         * @return null|string
         */
        public function getCategory():?string
        {
            return $this->category;
        }
    
        /**
         * @param  null|string  $category
         *
         * @return Permission
         */
        public function setCategory(?string $category):string
        {
            $this->category = $category;
        
            return $this;
        }
        
        /**
         * @return null|string
         */
        public function getSubcategory():?string
        {
            return $this->subcategory;
        }
    
        /**
         * @param  null|string  $subcategory
         *
         * @return Permission
         */
        public function setSubcategory(?string $subcategory):?string
        {
            $this->subcategory = $subcategory;
            
            return $this;
        }
    
    
        /**
         * @return int|null
         */
        public function getPermissionId():?int
        {
            return $this->permissionId;
        }
    
    
        /**
         * @return array|null
         * @see Permission
         */
        public function getRoles():?array
        {
            /*
             * Added the typecasting to tell PHPStorm to that it will not produce a possible fatal error
             */
            $roles = (array)$this->roles;
        
            /**
             * Make sure every user has a ROLE_USER entry in the system.
             */
            $roles[] = 'ROLE_USER';
        
            return array_unique($roles);
        }
    
        /**
         * @param  array  $roles
         *
         * @return Permission
         */
        public function setRoles(array $roles):self
        {
            $this->roles = $roles;
        
            return $this;
        }
    
    
        /**
         * @param  array  $newRoles
         *
         * @return Permission
         */
        public function appendRoles(array $newRoles):self
        {
            $existingRoles = $this->getRoles();
        
            $merged = array_merge($existingRoles, $newRoles);
        
            $this->setRoles($merged);
        
            return $this;
        }
	
	
	    /**
	     * @return string|null
	     */
	    public function getRole():?string
        {
            return $this->role;
        }
	
	    /**
	     * @param  string|null  $role
	     *
	     * @return $this
	     */
	    public function setRole(?string $role):self
        {
            $this->role = $role;
        
            return $this;
        }
    
        // public function getRoles():string
        // {
        //     return $this->roles;
        // }
    
        // public function setRoles(?array $roles): self
        // {
        //     $this->roles = $roles;
        //
        //     return $this;
        // }
	
	    /**
	     * @return bool|null
	     */
	    public function getCanCreate():?bool
        {
            return $this->canCreate;
        }
	
	    /**
	     * @param  bool  $canCreate
	     *
	     * @return $this
	     */
	    public function setCanCreate(bool $canCreate):self
        {
            $this->canCreate = $canCreate;
        
            return $this;
        }
	
	    /**
	     * @return bool|null
	     */
	    public function getCanView():?bool
        {
            return $this->canView;
        }
	
	    /**
	     * @param  bool  $canView
	     *
	     * @return $this
	     */
	    public function setCanView(bool $canView):self
        {
            $this->canView = $canView;
        
            return $this;
        }
	
	    /**
	     * @return bool|null
	     */
	    public function getCanUpdate():?bool
        {
            return $this->canUpdate;
        }
	
	    /**
	     * @param  bool  $canUpdate
	     *
	     * @return $this
	     */
	    public function setCanUpdate(bool $canUpdate):self
        {
            $this->canUpdate = $canUpdate;
        
            return $this;
        }
	
	    /**
	     * @return bool|null
	     */
	    public function getCanDelete():?bool
        {
            return $this->canDelete;
        }
	
	    /**
	     * @param  bool  $canDelete
	     *
	     * @return $this
	     */
	    public function setCanDelete(bool $canDelete):self
        {
            $this->canDelete = $canDelete;
        
            return $this;
        }
        
        
    }
