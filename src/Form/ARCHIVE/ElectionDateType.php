<?php
    
    namespace App\Form\ARCHIVE;

    use App\Entity\ElectionDate;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;

    /**
     * Class ElectionDateType
     *
     * @package App\Form
     */
    class ElectionDateType extends AbstractType
    {

        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add(
                'electionDateId',
                IntegerType::class,
                [
                  'disabled'       => true,
                  'label'          => 'Primary Key to Election_Date',
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
                'electionId',
                TextType::class,
                [
                  'disabled'       => true,
                  'label'          => 'Foreign Key to Election',
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
                'dateValue',
                DateTimeType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Date and Time of Election',
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
                    new NotBlank(
                      [
                        'message' => 'Please enter a Date and Time of Election ',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'dateLabel',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Label to Display With Date',
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
                    new NotBlank(
                      [
                        'message' => 'Please enter a Label to Display With Date ',
                      ]
                    ),
                    new Length(
                      [
                        'min'        => 1,
                        'minMessage' => 'Label to Display With Date must be at least {{ limit }} characters in length.',
                        'max'        => 512,
                        'maxMessage' => 'Label to Display With Date cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
            ;
        }

        /**
         * {@inheritdoc}
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
                'data_class' => ElectionDate::class,
              ]
            );
        }

    }




    //            ->add('dateValue')
    //            ->add('dateLabel')
    //            ->add('updatedAt')
    //            ->add('createdAt')
    //            ->add('isActive')
    //            ->add('election')
