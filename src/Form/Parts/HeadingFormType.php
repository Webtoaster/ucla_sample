<?php
    
    namespace App\Form\Parts;
    
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class PartDescriptionShortFormType
     *
     * @package App\Form\Parts
     */
    class HeadingFormType extends AbstractType
    {
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add(
                    'heading',
                    TextType::class,
                    [
                        'label'      => 'Election Heading',
                        'disabled'   => FALSE,
                        'empty_data' => NULL,
                        'help'       => 'Lead Banner Describing the Election.',
                        'mapped'     => TRUE,
                        'required'   => TRUE,
                        'trim'       => TRUE,
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
