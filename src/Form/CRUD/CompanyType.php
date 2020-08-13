<?php

    namespace App\Form\CRUD;

    use App\Entity\Company;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class CompanyType
     *
     * @package App\Form\CRUD
     */
    class CompanyType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add('numberOfSections')
              ->add('numberOfProperties')
              ->add('isManagementCompany')
              ->add('isAssociationCompany')
              ->add('createdFromIp')
              ->add('updatedFromIp')
              ->add('createdAt')
              ->add('updatedAt')
              ->add('companyName')
              ->add('billingAddressLine1')
              ->add('billingAddressLine2')
              ->add('billingAddressCity')
              ->add('billingAddressState')
              ->add('billingAddressZipCode')
              ->add('mailingAddressLine1')
              ->add('mailingAddressLine2')
              ->add('mailingAddressCity')
              ->add('mailingAddressState')
              ->add('mailingAddressZipCode')
              ->add('mailingAddressCountry')
              ->add('physicalAddressLine1')
              ->add('physicalAddressLine2')
              ->add('physicalAddressCity')
              ->add('physicalAddressState')
              ->add('physicalAddressZipCode')
              ->add('phoneWork')
              ->add('phoneFax')
              ->add('url')
              ->add('isActive')
              ->add('person')
            ;
        }


        /**
         * @param  OptionsResolver  $resolver
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
                'data_class' => Company::class,
              ]
            );
        }

    }
