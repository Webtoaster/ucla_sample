<?php
    
    namespace App\Form\Parts;
    
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
    
    /**
     * Class PartAssociationSizeInformationFormType
     *
     * @package App\Form\Parts
     */
    class AssociationSizeInformationFormType extends AbstractType
    {
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add(
                    'numberOfProperties',
                    IntegerType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'How Many Properties are under Management in this Community?',
                        'label_attr'     => [],
                        'label_format'   => NULL,
                        'help'           => NULL,
                        'help_attr'      => [],
                        'help_html'      => FALSE,
                        'attr'           => [
                            // 'placeholder' => '(250)',
                        ],
                        'data'           => 5,
                        'empty_data'     => 1,
                        'mapped'         => FALSE,
                        'required'       => TRUE,
                        'trim'           => TRUE,
                        'error_bubbling' => FALSE,
                        'error_mapping'  => [],
                        'constraints'    => [
                            new GreaterThanOrEqual(
                                [
                                    'value'   => 5,
                                    'message' => 'You have entered {{ value }} for the Number of Properties Under Management.  You must enter a minimum of {{ compared_value  }}.',
                                ]
                            ),
                        ],
                    ]
                )
                ->add(
                    'numberOfSections',
                    IntegerType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'Are there Divided Sections in this Community?',
                        'label_attr'     => [],
                        'label_format'   => NULL,
                        'help'           => NULL,
                        'help_attr'      => [],
                        'help_html'      => FALSE,
                        'attr'           => [
                            //  'placeholder' => '(5)',
                        ],
                        'data'           => 1,
                        'empty_data'     => 1,
                        'mapped'         => FALSE,
                        'required'       => TRUE,
                        'trim'           => TRUE,
                        'error_bubbling' => FALSE,
                        'error_mapping'  => [],
                        'constraints'    => [
                            new GreaterThanOrEqual(
                                [
                                    'value'   => 1,
                                    'message' => 'You have entered {{ value }} for the Number of Divided Sections in your Community.  You must enter a minimum of {{ compared_value }}.',
                                ]
                            ),
                        ],
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
                    'inherit_data' => TRUE,
                ]
            );
        }
        
        
    }
