<?php

    namespace App\Form\CRUD;

    use App\Entity\Person;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class PersonType
     *
     * @package App\Form\CRUD
     */
    class PersonType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            /**
             * {@inheritdoc}
             */
            $builder
              ->add('password')
              ->add('passwordRecoveryKey')
              ->add('passwordRecoveryDate')
              ->add('passwordRecoveryIpAddress')
              ->add('roles')
              ->add('verificationKey')
              ->add('verificationDate')
              ->add('verificationIpAddress')
              ->add('hasStartedRegistration')
              ->add('isVerified')
              ->add('isRegistered')
              ->add('agreedToTermsAt')
              ->add('termsId')
              ->add('createdFromIp')
              ->add('updatedFromIp')
              ->add('createdAt')
              ->add('updatedAt')
              ->add('nameFirst')
              ->add('nameMiddle')
              ->add('nameLast')
              ->add('nameSuffix')
              ->add('nameTrustee')
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
              ->add('email')
              ->add('phoneHome')
              ->add('phoneWork')
              ->add('phoneMobile')
              ->add('isActive')
              ->add('personType')
            ;
        }

        /**
         * {@inheritdoc}
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
                'data_class' => Person::class,
              ]
            );
        }

    }
