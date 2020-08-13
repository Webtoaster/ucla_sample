<?php
    
    namespace App\Form\Parts;
    
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class LegalDescriptionFullFormType
     *
     * @package App\Form\Parts
     */
    class LegalDescriptionFullFormType extends AbstractType
    {
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
	            ->add('legalDescription',
		            TextareaType::class,
		            [
			            // 'attr'           => ['class' => ''],
			            // 'data'           => '',
			            'disabled' => FALSE,
			            // 'required'       => FALSE,
			            // 'empty_data'     => 'John Doe',
			            // 'error_bubbling' => FALSE,
			            // 'error_mapping'  => [],
			            'help'     => 'Can contain the Metes and Bounds of a Property.',
			            // 'help_attr'      => [],
			            // 'help_html'      => FALSE,
			            'label'    => 'Full Legal Description',
			            // 'label_attr'     => [],
			            // 'label_format'   => NULL,
			            'mapped'   => TRUE,
			            // 'row_attr'       => [],
			            'trim'     => TRUE,
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
