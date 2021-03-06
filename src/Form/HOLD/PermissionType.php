<?php
    
    namespace App\Form\HOLD;

    use App\Entity\Permission;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class PermissionType
     *
     * @package App\Form
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
              ->add(
                'description',
                TextType::class,
                [
                  'label'          => '',
                  'label_attr'     => [],
                  'mapped'         => true,
                  'required'       => true,
                  'trim'           => true,
                  'disabled'       => false,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                  'help'           => null,
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [
                    'placeholder' => '',
                  ],

                ]
              )
              ->add(
                'htmlDescriptionLong',
                TextType::class,
                [
                  'label'          => '',
                  'label_attr'     => [],
                  'mapped'         => true,
                  'required'       => true,
                  'trim'           => true,
                  'disabled'       => false,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                  'help'           => null,
                  'help_attr'      => [],
                  'help_html'      => false,

                ]
              )
              ->add(
                'permissionGroup',
                TextType::class,
                [
                  'label'          => '',
                  'label_attr'     => [],
                  'mapped'         => true,
                  'required'       => true,
                  'trim'           => true,
                  'disabled'       => false,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                  'help'           => null,
                  'help_attr'      => [],
                  'help_html'      => false,
                ]
              )
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
