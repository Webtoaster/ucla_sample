<?php
    
    namespace App\Form\HOLD;
    
    use App\Entity\AssociationStaff;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
    use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;
    
    /**
     * Class AssociationStaffType
     *
     * @package App\Form
     */
    class AssociationStaffType extends AbstractType
    {
        
        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add(
                    'associationId',
                    TextType::class,
                    [
                        'disabled'       => TRUE,
                        'label'          => 'Foreign Key to Association',
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
                    'personId',
                    TextType::class,
                    [
                        'disabled'       => TRUE,
                        'label'          => 'Foreign Key to Person',
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
                    'jobTitle',
                    TextType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'Job Title or Description',
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
                        'constraints'    => [
                            new Length(
                                [
                                    'max'        => 128,
                                    'maxMessage' => 'Job Title or Description cannot exceed {{ limit }} characters.',
                                ]
                            ),
                        ],
                    ]
                )
                ->add(
                    'isAttorney',
                    CheckboxType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'Is Staff Member Association Counsel',
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
                    'isBoardMember',
                    CheckboxType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'Is This Staff Member Also a Board Member?',
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
                        'constraints'    => [
                            new NotBlank(['message' => 'Please enter a Is This Staff Member Also a Board Member? ',]),
                        ],
                    ]
                )
                ->add(
                    'dateStart',
                    DateTimeType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'Date Start',
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
                    'dateEnd',
                    DateTimeType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'Date End',
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
            ;
        }
        
        /**
         * @param  OptionsResolver  $resolver
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
                [
                    'data_class' => AssociationStaff::class,
                ]
            );
        }
        
    }
    
    //				->add('isAttorney')
    //				->add('jobTitle')
    //				->add('isBoardMember')
    //				->add('dateStart')
    //				->add('dateEnd')
    //				->add('updatedAt')
    //				->add('createdAt')
    //				->add('isActive')
    //				->add('association')
    //				->add('person')
