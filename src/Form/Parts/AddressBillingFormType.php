<?php
    
    namespace App\Form\Parts;
    
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class PartAddressBillingFormType
     *
     * @package App\Form\Parts
     */
    class AddressBillingFormType extends AbstractType
    {
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add(
                    'billingAddressLine1',
                    TextType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'Address Line 1',
                        'label_attr'     => [],
                        'label_format'   => NULL,
                        'help'           => '',
                        'help_attr'      => [],
                        'help_html'      => FALSE,
                        'attr'           => [
                            'placeholder' => '(123 Main Street)',
                        ],
                        'mapped'         => TRUE,
                        'required'       => FALSE,
                        'trim'           => TRUE,
                        'error_bubbling' => FALSE,
                        'error_mapping'  => [],
                    ]
                )
                ->add(
                    'billingAddressLine2',
                    TextType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'Address Line 2',
                        'label_attr'     => [],
                        'label_format'   => NULL,
                        'help'           => '',
                        'help_attr'      => [],
                        'help_html'      => FALSE,
                        'attr'           => [],
                        'mapped'         => TRUE,
                        'required'       => FALSE,
                        'trim'           => TRUE,
                        'error_bubbling' => FALSE,
                        'error_mapping'  => [],
                    ]
                )
                ->add(
                    'billingAddressCity',
                    TextType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'City',
                        'label_attr'     => [],
                        'label_format'   => NULL,
                        'help'           => '',
                        'help_attr'      => [],
                        'help_html'      => FALSE,
                        'attr'           => [
                            'placeholder' => '(Houston)',
                        ],
                        'mapped'         => TRUE,
                        'required'       => FALSE,
                        'trim'           => TRUE,
                        'error_bubbling' => FALSE,
                        'error_mapping'  => [],
                    ]
                )
                ->add(
                    'billingAddressState',
                    TextType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'State',
                        'label_attr'     => [],
                        'label_format'   => NULL,
                        'help'           => '',
                        'help_attr'      => [],
                        'help_html'      => FALSE,
                        'attr'           => [],
                        'mapped'         => TRUE,
                        'required'       => FALSE,
                        'trim'           => TRUE,
                        'error_bubbling' => FALSE,
                        'error_mapping'  => [],
                    ]
                )
                ->add(
                    'billingAddressZipCode',
                    TextType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'Zip Code',
                        'label_attr'     => [],
                        'label_format'   => NULL,
                        'help'           => '',
                        'help_attr'      => [],
                        'help_html'      => FALSE,
                        'attr'           => [
                            'placeholder' => '(75123 or 75123-1221)',
                        ],
                        'mapped'         => TRUE,
                        'required'       => FALSE,
                        'trim'           => TRUE,
                        'error_bubbling' => FALSE,
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
                    'inherit_data' => TRUE,
                ]
            );
        }
        
        
    }
