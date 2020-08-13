<?php
    
    namespace App\Form\Parts;
    
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class PartDisplayDescriptionLongFormType
     *
     * @package App\Form\Parts
     */
    class DisplayDescriptionLongFormType extends AbstractType
    {
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add(
                    'displayDescriptionLong',
                    CheckboxType::class,
                    [
                        'label'    => 'Display the Expanded Description?',
                        'disabled' => FALSE,
                        'help'     => 'Display the Expanded Description on the Form or User Interface.',
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
