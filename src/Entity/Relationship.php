<?php
    
    namespace App\Entity;
    
    use App\Entity\Common\BooleanIsActiveTrait;
    use Doctrine\ORM\Mapping as ORM;
    use Gedmo\IpTraceable\Traits\IpTraceableEntity;
    use Gedmo\Timestampable\Traits\TimestampableEntity;
    
    /**
     * @ORM\Table(
     *     name="relationship",
     *     indexes={
     *          @ORM\Index(name="idx_relationship_association_id",                      columns={"association_id"}),
     *          @ORM\Index(name="idx_relationship_election_id",                         columns={"election_id"}),
     *          @ORM\Index(name="idx_relationship_owner_id",                            columns={"owner_id"}),
     *          @ORM\Index(name="idx_relationship_company_id",                          columns={"company_id"}),
     *          @ORM\Index(name="idx_relationship_permission_id",                       columns={"permission_id"}),
     *          @ORM\Index(name="idx_relationship_person_id",                           columns={"person_id"}),
     *          @ORM\Index(name="idx_relationship_supervisor_id",                       columns={"supervisor_id"}),
     *          @ORM\Index(name="idx_relationship_relationship_type_id",                columns={"relationship_type_id"}),
     *          @ORM\Index(name="idx_relationship_person_and_association_id",           columns={"person_id", "association_id"}),
     *          @ORM\Index(name="idx_relationship_person_and_company_id",               columns={"person_id", "company_id"}),
     *          @ORM\Index(name="idx_relationship_person_and_permission_id",            columns={"person_id", "permission_id"}),
     *          @ORM\Index(name="idx_relationship_person_and_supervisor_id",            columns={"person_id", "supervisor_id"}),
     *          @ORM\Index(name="idx_relationship_person_and_relationship_type_id",     columns={"person_id", "relationship_type_id"})
     *     }
     * )
     * @ORM\Entity(repositoryClass="App\Repository\RelationshipRepository")
     */
    class Relationship
    {
        
        /**
         * @ORM\Column(
         *     name="relationship_id",
         *     type="integer",
         *     nullable=false,
         *     options={"unsigned"=true,"comment"="Primary Key for relationships"}
         *     )
         *
         * @ORM\Id()
         * @ORM\GeneratedValue(strategy="AUTO")
         * @ORM\Column(type="integer")
         */
        private $relationshipId;
	
	
	    /**
         * @ORM\ManyToOne(
         *     targetEntity="Person"
         * )
         * @ORM\JoinColumn(
         *     name="person_id",
         *     referencedColumnName="id",
         *     nullable=true,
         *     onDelete="SET NULL"
         * )
         */
        private $person;
	
	
	    /**
         * @ORM\ManyToOne(
         *     targetEntity="Person"
         * )
         *
         * @ORM\JoinColumn(
         *     name="supervisor_id",
         *     referencedColumnName="id",
         *     nullable=true,
         *     onDelete="SET NULL"
         * )
         */
        private $supervisor;
	
	
	    /**
         * @ORM\ManyToOne(
         *     targetEntity="Company",
         *     inversedBy="relationship"
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
         *
         * @ORM\JoinColumn(
         *     name="association_id",
         *     referencedColumnName="company_id",
         *     nullable=true,
         *     onDelete="SET NULL"
         * )
         */
        private $association;
        
        /**
         * @ORM\ManyToOne(
         *     targetEntity="Election"
         * )
         *
         * @ORM\JoinColumn(
         *     name="election_id",
         *     referencedColumnName="election_id",
         *     nullable=true,
         *     onDelete="SET NULL"
         * )
         */
        private $election;
	
	
	    /**
         * @ORM\ManyToOne(
         *     targetEntity="Owner"
         * )
         * @ORM\JoinColumn(
         *     name="owner_id",
         *     referencedColumnName="owner_id",
         *     nullable=true,
         *     onDelete="SET NULL"
         * )
         */
        private $owner;
	
	
	    /**
         * @ORM\ManyToOne(
         *     targetEntity="Owner"
         * )
         * @ORM\JoinColumn(
         *     name="proxy_id",
         *     referencedColumnName="owner_id",
         *     nullable=true,
         *     onDelete="SET NULL"
         * )
         */
        private $proxy;
	
	
	    /**
         * @ORM\ManyToOne(
         *     targetEntity="Permission"
         * )
         * @ORM\JoinColumn(
         *     name="permission_id",
         *     referencedColumnName="permission_id",
         *     nullable=true,
         *     onDelete="SET NULL"
         * )
         */
        private $permission;
        
        /**
         * @ORM\ManyToOne(
         *     targetEntity="RelationshipType"
         * )
         * @ORM\JoinColumn(
         *     name="relationship_type_id",
         *     referencedColumnName="relationship_type_id",
         *     nullable=true,
         *     onDelete="SET NULL"
         * )
         */
        private $relationshipType;
        
        use IpTraceableEntity;
        use TimestampableEntity;
        use BooleanIsActiveTrait;
        
        /**
         * @return null|int
         */
        public function getRelationshipId():?int
        {
            return $this->relationshipId;
        }
        
        /**
         * @return null|Person
         */
        public function getPerson():?Person
        {
            return $this->person;
        }
        
        /**
         * @param  null|Person  $person
         *
         * @return self
         */
        public function setPerson(?Person $person):self
        {
            $this->person = $person;
            
            return $this;
        }
        
        /**
         * @return null|Person
         */
        public function getSupervisor():?Person
        {
            return $this->supervisor;
        }
        
        /**
         * @param  null|Person  $supervisor
         *
         * @return self
         */
        public function setSupervisor(?Person $supervisor):self
        {
            $this->supervisor = $supervisor;
            
            return $this;
        }
        
        /**
         * @return null|Company
         */
        public function getCompany():?Company
        {
            return $this->company;
        }
        
        /**
         * @param  null|Company  $company
         *
         * @return self
         */
        public function setCompany(?Company $company):self
        {
            $this->company = $company;
            
            return $this;
        }
        
        /**
         * @return null|Company
         */
        public function getAssociation():?Company
        {
            return $this->association;
        }
        
        /**
         * @param  null|Company  $association
         *
         * @return self
         */
        public function setAssociation(?Company $association):self
        {
            $this->association = $association;
            
            return $this;
        }
        
        /**
         * @return null|Permission
         */
        public function getPermission():?Permission
        {
            return $this->permission;
        }
        
        /**
         * @param  null|Permission  $permission
         *
         * @return self
         */
        public function setPermission(?Permission $permission):self
        {
            $this->permission = $permission;
            
            return $this;
        }
        
        /**
         * @return null|RelationshipType
         */
        public function getRelationshipType():?RelationshipType
        {
            return $this->relationshipType;
        }
        
        
        /**
         * @param  null|RelationshipType  $relationshipType
         *
         * @return self
         */
        public function setRelationshipType(?RelationshipType $relationshipType):self
        {
            $this->relationshipType = $relationshipType;
            
            return $this;
        }
        
        
        /**
         * @return null|Owner
         */
        public function getOwner():?Owner
        {
            return $this->owner;
        }
        
        
        /**
         * @param  null|Owner  $owner
         *
         * @return self
         */
        public function setOwner(?Owner $owner):self
        {
            $this->owner = $owner;
            
            return $this;
        }
        
        
        /**
         * @return null|Election
         */
        public function getElection():?Election
        {
            return $this->election;
        }
        
        
        /**
         * @param  null|Election  $election
         *
         * @return self
         */
        public function setElection(?Election $election):self
        {
            $this->election = $election;
	
	        return $this;
        }
	
	    /**
	     * @return null|Owner
	     */
	    public function getProxy():?Owner
	    {
		    return $this->proxy;
	    }
	
	    /**
	     * @param  null|Owner  $proxy
	     *
	     * @return self
	     */
	    public function setProxy(?Owner $proxy):self
	    {
		    $this->proxy = $proxy;
		
		    return $this;
	    }
        
        
    }
