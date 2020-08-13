<?php
    
    namespace App\Form\Parts;
    
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class PartDisplayDescriptionLongFormType
     *
     * @package App\Form\Parts
     */
    class HeadingSubFormType extends AbstractType
    {
    
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add(
                    'subheading',
                    TextType::class,
                    [
                        'label'    => 'Election Subheading',
                        'disabled' => FALSE,
                        'help'     => 'Expanded Description of the Election to take place.',
                        'mapped'   => TRUE,
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
