<?php
    
    namespace App\Form\ARCHIVE;

    use App\Entity\Owner;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class OwnerType
     *
     * @package App\Form
     */
    class OwnerType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder

              ->add('association')

              ->add('proxyId')


              ->add('nameDisplay')

              ->add('nameFirst')
              ->add('nameMiddle')
              ->add('nameLast')
              ->add('nameSuffix')

              ->add('email')

              ->add('phoneWork')

              ->add('phoneHome')

              ->add('phoneMobile')

              ->add('phoneFax')



              ->add('userName')
              ->add('password')



              ->add('physicalAddressLine1')
              ->add('physicalAddressLine2')
              ->add('physicalAddressCity')
              ->add('physicalAddressState')
              ->add('physicalAddressZipCode')

              ->add('mailingAddressLine1')
              ->add('mailingAddressLine2')
              ->add('mailingAddressCity')
              ->add('mailingAddressState')
              ->add('mailingAddressZipCode')

              ->add('isActive')

            ;
        }

        /**
         * @param  OptionsResolver  $resolver
         */
        /**
         * @param  OptionsResolver  $resolver
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
                'data_class' => Owner::class,
              ]
            );
        }

    }
