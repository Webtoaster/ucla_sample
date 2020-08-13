<?php
    
    namespace App\Form\ARCHIVE;

    use App\Entity\AssociationStaffPermission;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class AssociationStaffPermissionType
     *
     * @package App\Form
     */
    class AssociationStaffPermissionType extends AbstractType
    {


        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add('associationStaff')
              ->add('permission')
            ;
        }

        /**
         * @param  OptionsResolver  $resolver
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
                'data_class' => AssociationStaffPermission::class,
              ]
            );
        }

    }
