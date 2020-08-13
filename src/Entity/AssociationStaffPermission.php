<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\BooleanIsActiveTrait;
    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;

    /**
     * AssociationStaffPermission
     *
     * @ORM\Table(
     *      name="association_staff_permission",
     *      indexes={
     *          @ORM\Index(name="fk_idx_association_staff_permission_to_permission",            columns={"permission_id"}),
     *          @ORM\Index(name="fk_idx_association_staff_permission_to_associationStaff",      columns={"association_staff_id"})
     *      }
     * )
     *
     * @ORM\Entity(
     *     repositoryClass="App\Repository\AssociationStaffPermissionRepository"
     * )
     */
    class AssociationStaffPermission
    {
    
        /**
         * @var int $associationStaffPermissionId
         *
         * @ORM\Column(
         *     name="association_staff_permission_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for table"}
         *     )
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $associationStaffPermissionId;
    
    
        /**
         * @var int $associationStaff
         *
         * @ORM\ManyToOne(
         *     targetEntity="AssociationStaff"
         * )
         * @ORM\JoinColumn(
         *     nullable=false,
         *     name="association_staff_id",
         *     referencedColumnName="association_staff_id"
         * )
         */
        protected $associationStaff;
    
    
        /**
         * @var Permission|int $permission
         *
         * @ORM\ManyToOne(
         *     targetEntity="App\Entity\Permission"
         * )
         * @ORM\JoinColumn(
         *     nullable=false,
         *     name="permission_id",
         *     referencedColumnName="permission_id"
         * )
         */
        protected $permission;
    
    
        // @formatter:off
        /**
         * Common Trait Patterns to All Entities
         */
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
        // @formatter:on
    
    
        /**
         * @return int|null
         */
        public function getAssociationStaff():?int
        {
            return $this->associationStaff;
        }
    
        /**
         * @param  AssociationStaff|null  $associationStaff
         *
         * @return AssociationStaffPermission
         */
        public function setAssociationStaff(?AssociationStaff $associationStaff):self
        {
            $this->associationStaff = $associationStaff;
    
            return $this;
        }
    
        /**
         * @return Permission|null
         */
        public function getPermission():?Permission
        {
            return $this->permission;
        }
    
        /**
         * @param  Permission|null  $permission
         *
         * @return AssociationStaffPermission
         */
        public function setPermission(?Permission $permission):self
        {
            $this->permission = $permission;
    
            return $this;
        }
    
    
        /**
         * @return int|null
         */
        public function getAssociationStaffPermissionId():?int
        {
            return $this->associationStaffPermissionId;
        }
    
    
    }
