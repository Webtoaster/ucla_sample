<?php
    
    namespace App\Form\ARCHIVE;

    use App\Entity\BallotType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\UrlType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;

    /**
     * Class BallotTypeType
     *
     * @package App\Form
     */
    class BallotTypeType extends AbstractType
    {

        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add(
                'ballotTypeId',
                IntegerType::class,
                [
                  'disabled'       => true,
                  'label'          => 'Primary Key to Ballot_Type',
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
                'ballotType',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Description of a Ballot Type.  (Ie, Electronic, Proxy, etc.)',
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
                        'message' => 'Please enter a Description of a Ballot Type.  (Ie, Electronic, Proxy, etc.) ',
                      ]
                    ),
                    new Length(
                      [
                        'min'        => 1,
                        'minMessage' => 'Description of a Ballot Type.  (Ie, Electronic, Proxy, etc.) must be at least {{ limit }} characters in length.',
                        'max'        => 128,
                        'maxMessage' => 'Description of a Ballot Type.  (Ie, Electronic, Proxy, etc.) cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'urlBallotType',
                UrlType::class,
                [
                  'disabled'       => false,
                  'label'          => 'URL Link to get to Page Describing The Ballot Type',
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
                        'max'        => 255,
                        'maxMessage' => 'URL Link to get to Page Describing The Ballot Type cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'htmlBallotType',
                TextareaType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Html Describing The Ballot Type',
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
                        'maxMessage' => 'Html Describing The Ballot Type cannot exceed {{ limit }} characters.',
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
                'data_class' => BallotType::class,
              ]
            );
        }

    }


    //            ->add('ballotType')
    //            ->add('urlBallotType')
    //            ->add('htmlBallotType')
    //            ->add('updatedAt')
    //            ->add('createdAt')
    //            ->add('isActive')
