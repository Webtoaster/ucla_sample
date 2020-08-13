<?php
    
    namespace App\Form\Parts;
    
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class PartNameCompanyFormType
     *
     * @package App\Form\Parts
     */
    class NameFormalFormType extends AbstractType
    {
        
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add(
                    'nameFormal',
                    TextType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'Name (Complete)',
                        'label_attr'     => [],
                        'label_format'   => NULL,
                        'help'           => NULL,
                        'help_attr'      => [],
                        'help_html'      => FALSE,
                        'attr'           => [
                            'placeholder' => '(ACME Company Inc.)',
                        ],
                        'mapped'         => TRUE,
                        'required'       => TRUE,
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
