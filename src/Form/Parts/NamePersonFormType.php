<?php
    
    namespace App\Form\Parts;
    
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class PartNamePersonFormType
     *
     * @package App\Form\Parts
     */
    class NamePersonFormType extends AbstractType
    {
        
        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add(
                    'nameFirst',
                    TextType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'First Name',
                        'label_attr'     => [],
                        'label_format'   => NULL,
                        'help'           => '',
                        'help_attr'      => [],
                        'help_html'      => FALSE,
                        'attr'           => [],
                        'mapped'         => TRUE,
                        'required'       => TRUE,
                        'trim'           => TRUE,
                        'error_bubbling' => FALSE,
                        'error_mapping'  => [],
                    ]
                )
                ->add(
                    'nameMiddle',
                    TextType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'Middle Name',
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
                    'nameLast',
                    TextType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'Last Name',
                        'label_attr'     => [],
                        'label_format'   => NULL,
                        'help'           => '',
                        'help_attr'      => [],
                        'help_html'      => FALSE,
                        'attr'           => [],
                        'mapped'         => TRUE,
                        'required'       => TRUE,
                        'trim'           => TRUE,
                        'error_bubbling' => FALSE,
                        'error_mapping'  => [],
                    ]
                )
                //->add('nameSuffix', TextType::class, [
                //  'disabled'       => FALSE,
                //  'label'          => 'Suffix',
                //  'label_attr'     => [],
                //  'label_format'   => NULL,
                //  'help'           => '',
                //  'help_attr'      => [],
                //  'help_html'      => FALSE,
                //  'attr'           => [],
                //  'mapped'         => TRUE,
                //  'required'       => FALSE,
                //  'trim'           => TRUE,
                //  'error_bubbling' => FALSE,
                //  'error_mapping'  => [],
                //])
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
