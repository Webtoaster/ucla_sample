<?php

    namespace App\Form\Model;

    use App\Repository\PersonTypeRepository;
    use Doctrine\DBAL\DBALException;
    use Symfony\Component\Validator\Constraints as Assert;
    use Symfony\Component\Validator\Mapping\ClassMetadata;

    /**
     * Class NewRegistrantModel
     *
     * @package App\Form\Model
     */
    class NewRegistrantModel
    {

        public $newRegistrant;

        /**
         *
         * @param  ClassMetadata  $metadata
         */
        public function loadValidatorMetadata(ClassMetadata $metadata):void
        {
            $metadata->addPropertyConstraint(
              'newRegistrant',
              new Assert\Choice(
                [
                  'choices' => $this->getChoicesValues(),
                  'message' => 'Choose one of the options below.',
                ]
              )
            );
        }

        /**
         *
         * @return array
         */
        public function getChoicesValues():array
        {
            return array_values(self::choices);
        }

        // private $choices = [
        // 'I work for a Self-Managed Homeowner\'s / Property Owner\'s Association.' => 'association_self_managed',
        // 'I work for a HOA Management Company.' => 'association_management_company',
        // 'I am a Member of an Association Evaluating the Software.' => 'association_member_testing',
        // ];
    
        /**
         * @throws DBALException
         * @return array
         */
        public function getChoicesArray():array
        {
            return $this->getChoices();
        }
    
        /**
         *
         * @param  PersonTypeRepository  $repository
         *
         * @throws DBALException
         * @return array
         */
        public function getChoices(PersonTypeRepository $repository):array
        {
            $rs = $repository->queryForPersonTypeForm();

            dd($rs);

            return $rs;
        }

    }
