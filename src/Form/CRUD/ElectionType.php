<?php

    namespace App\Form\CRUD;

    use App\Entity\Election;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class ElectionType
     *
     * @package App\Form\CRUD
     */
    class ElectionType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add('electionNameHeading')
              ->add('electionNameSubheading')
              ->add('urlElection')
              ->add('htmlElectionInformation')
              ->add('physicalAddressLine1')
              ->add('physicalAddressLine2')
              ->add('physicalAddressCity')
              ->add('physicalAddressState')
              ->add('physicalAddressZipCode')
              ->add('displayPhysicalAddress')
              ->add('mailingAddressLine1')
              ->add('mailingAddressLine2')
              ->add('mailingAddressCity')
              ->add('mailingAddressState')
              ->add('mailingAddressZipCode')
              ->add('displayMailingAddress')
              ->add('votesMin')
              ->add('votesMax')
              ->add('dateStart')
              ->add('dateEnd')
              ->add('votersTotal')
              ->add('votersRequiredElection')
              ->add('votersRequiredRatification')
              ->add('electionState')
              ->add('allowWriteInCandidates')
              ->add('allowProxyVoting')
              ->add('allowProxyDirected')
              ->add('allowProxyNondirected')
              ->add('isActive')
              ->add('createdFromIp')
              ->add('updatedFromIp')
              ->add('createdAt')
              ->add('updatedAt')
              ->add('electionType')
              ->add('association')
            ;
        }


        /**
         * @param  OptionsResolver  $resolver
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
                'data_class' => Election::class,
              ]
            );
        }

    }
