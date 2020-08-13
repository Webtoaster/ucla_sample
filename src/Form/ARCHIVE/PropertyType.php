<?php
    
    namespace App\Form\ARCHIVE;

    use App\Entity\Property;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
    use Symfony\Component\Form\Extension\Core\Type\HiddenType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;

    /**
     * Class PropertyType
     *
     * @package App\Form
     */
    class PropertyType extends AbstractType
    {

        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add(
                'propertyId',
                HiddenType::class,
                [
                  'disabled'       => true,
                  'label'          => 'Primary Key to Property',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => true,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                ]
              )
              ->add(
                'ownerId',
                TextType::class,
                [
                  'disabled'       => true,
                  'label'          => 'Foreign Key to Owner',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => false,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                ]
              )
              ->add(
                'associationId',
                TextType::class,
                [
                  'disabled'       => true,
                  'label'          => 'Foreign Key to Association',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => false,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                ]
              )
              ->add(
                'extHoaPropertyId',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'External Key From Internal Association System',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => false,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                  'constraints'    => [
                    new Length(
                      [
                        'max'        => 128,
                        'maxMessage' => 'External Key From Internal Association System cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'extCadPropertyId',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'External Key From County Appraisal District',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => false,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                  'constraints'    => [
                    new Length(
                      [
                        'max'        => 128,
                        'maxMessage' => 'External Key From County Appraisal District cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'dateStart',
                DateTimeType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Date Ownership Started',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => true,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                  'constraints'    => [
                    new NotBlank(['message' => 'Please enter a Date Ownership Started ',]),
                  ],
                ]
              )
              ->add(
                'dateEnd',
                DateTimeType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Date Ownership Ended',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => false,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                ]
              )
              ->add(
                'physicalAddress',
                PartAddressPhysicalFormType::class,
                [
                  'data_class' => Property::class,
                ]
              )
              ->add(
                'legalLot',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Legal Description - Lot',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => false,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                  'constraints'    => [
                    new Length(
                      [
                        'max'        => 32,
                        'maxMessage' => 'Legal Description Lot cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'legalSection',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Legal Description - Section',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => false,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                  'constraints'    => [
                    new Length(
                      [
                        'max'        => 32,
                        'maxMessage' => 'Legal Description Section cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'legalBlock',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Legal Description - Block',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => false,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                  'constraints'    => [
                    new Length(
                      [
                        'max'        => 32,
                        'maxMessage' => 'Legal Description Block cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'legalDescription',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Full Legal - Description',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => false,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                  'constraints'    => [
                    new Length(
                      [
                        'max'        => 65535,
                        'maxMessage' => 'Full Legal Description cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
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
                'data_class' => Property::class,
              ]
            );
        }

    }



    //            ->add('extHoaPropertyId')
    //            ->add('extCadPropertyId')
    //            ->add('dateStart')
    //            ->add('dateEnd')
    //            ->add('physicalAddressLine1')
    //            ->add('physicalAddressLine2')
    //            ->add('physicalAddressCity')
    //            ->add('physicalAddressState')
    //            ->add('physicalAddressZipCode')
    //            ->add('legalLot')
    //            ->add('legalSection')
    //            ->add('legalBlock')
    //            ->add('legalDescription')
    //            ->add('updatedAt')
    //            ->add('createdAt')
    //            ->add('isActive')
    //            ->add('association')
    //            ->add('owner')

