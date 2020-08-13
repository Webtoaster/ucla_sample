<?php

    namespace App\Form\CRUD;

    use App\Entity\Candidate;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class CandidateType
     *
     * @package App\Form\CRUD
     */

    /**
     * Class CandidateType
     *
     * @package App\Form\CRUD
     */
    class CandidateType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add('isWriteIn')
              ->add('writeInByVoterId')
              ->add('displayCandidateAddress')
              ->add('shareWriteInName')
              ->add('createdFromIp')
              ->add('updatedFromIp')
              ->add('createdAt')
              ->add('updatedAt')
              ->add('nameFirst')
              ->add('nameMiddle')
              ->add('nameLast')
              ->add('nameSuffix')
              ->add('nameDisplay')
              ->add('physicalAddressLine1')
              ->add('physicalAddressLine2')
              ->add('physicalAddressCity')
              ->add('physicalAddressState')
              ->add('physicalAddressZipCode')
              ->add('phoneMobile')
              ->add('phoneHome')
              ->add('email')
              ->add('url')
              ->add('isActive')
              ->add('election')
            ;
        }


        /**
         * @param  OptionsResolver  $resolver
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
                'data_class' => Candidate::class,
              ]
            );
        }

    }
