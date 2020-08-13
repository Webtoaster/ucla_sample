<?php
    
    namespace App\Form\Parts;
    
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TelType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class PartPhoneWorkFormType
     *
     * @package App\Form\Parts
     */
    class PhoneWorkFormType extends AbstractType
    {
        
        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add(
                    'phoneWork',
                    TelType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'Office Phone',
                        'label_attr'     => [],
                        'label_format'   => NULL,
                        'help'           => '',
                        'help_attr'      => [],
                        'help_html'      => FALSE,
                        'attr'           => [
                            'placeholder' => '(###-###-####)',
                        ],
                        'mapped'         => TRUE,
                        'required'       => FALSE,
                        'trim'           => TRUE,
                        'error_bubbling' => FALSE,
                        'error_mapping'  => [],
                    ]
                );
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
