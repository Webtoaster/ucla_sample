<?php
    
    namespace App\Form\Parts;
    
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class PartDescriptionLongFormType
     *
     * @package App\Form\Parts
     */
    class DescriptionLongFormType extends AbstractType
    {
    
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add(
                    'descriptionLong',
                    TextareaType::class,
                    [
                        'label'      => 'Expanded Description',
                        'disabled'   => FALSE,
                        'empty_data' => NULL,
                        'help'       => NULL,
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
