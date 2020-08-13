<?php
    
    namespace App\Form\ARCHIVE;

    use App\Entity\Association;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class AssociationType
     *
     * @package App\Form
     */
    class AssociationType extends AbstractType
    {

        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              // ->add(
              //   'associationId',
              //   IntegerType::class,
              //   [
              //     'disabled'       => true,
              //     'label'          => 'Primary Key to Association',
              //     'label_attr'     => [],
              //     'label_format'   => null,
              //     'help'           => '',
              //     'help_attr'      => [],
              //     'help_html'      => false,
              //     'attr'           => [],
              //     'mapped'         => true,
              //     'required'       => true,
              //     'trim'           => true,
              //     'error_bubbling' => false,
              //     'error_mapping'  => [],
              //   ]
              // )
              ->add(
                'companyId',
                IntegerType::class,
                [
                  'disabled'       => true,
                  'label'          => 'Foreign Key to Company',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => false,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                ]
              )
              ->add(
                'numberOfProperties',
                IntegerType::class,
                [
                  'disabled'       => false,
                  'label'          => 'How Many Properties are under Management in this Community?',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => null,
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [
                    'placeholder' => '(250)',
                  ],
                  'mapped'         => true,
                  'required'       => true,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                ]
              )
              ->add(
                'numberOfSections',
                IntegerType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Are there Divided Sections in this Community?',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => null,
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [
                    'placeholder' => '(3)',
                  ],
                  'empty_data'     => 1,
                  'mapped'         => true,
                  'required'       => false,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
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
                'data_class' => Association::class,
              ]
            );
        }

    }


    //				->add('numberOfProperties')
    //				->add('numberOfSections')
    //				->add('updatedAt')
    //				->add('createdAt')
    //				->add('isActive')
    //				->add('company')
    //				->add('managementCompany')
