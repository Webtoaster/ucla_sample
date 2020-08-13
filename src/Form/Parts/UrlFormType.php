<?php
    
    namespace App\Form\Parts;
    
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\UrlType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class PartUrlFormType
     *
     * @package App\Form\Parts
     */
    class UrlFormType extends AbstractType
    {
        
        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add(
                    'url',
                    UrlType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'URL of Company Web Site',
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
