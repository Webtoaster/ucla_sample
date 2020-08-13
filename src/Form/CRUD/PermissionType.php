<?php

    namespace App\Form\CRUD;

    use App\Entity\Permission;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class PermissionType
     *
     * @package App\Form\CRUD
     */
    class PermissionType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add('description')
              ->add('htmlDescriptionLong')
              ->add('permissionGroup')
            ;
        }


        /**
         * @param  OptionsResolver  $resolver
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
                'data_class' => Permission::class,
              ]
            );
        }

    }
