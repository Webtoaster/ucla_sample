<?php
    
    namespace App\Form\ARCHIVE;
    
    use App\Entity\Ballot;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\UrlType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\Length;
    
    /**
     * Class BallotType
     *
     * @package App\Form
     */
    class BallotType extends AbstractType
    {
        
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add(
                    'voterId',
                    TextType::class,
                    [
                        'disabled'       => TRUE,
                        'label'          => 'Foreign Key to Voter',
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
                    'ballotTypeId',
                    TextType::class,
                    [
                        'disabled'       => TRUE,
                        'label'          => 'Foreign Key to Ballot_Type',
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
                    'ballotKey',
                    TextType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'Key to Transfer a Ballot to a Proxy',
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
                                    'max'        => 64,
                                    'maxMessage' => 'Key to Transfer a Ballot to a Proxy cannot exceed {{ limit }} characters.',
                                ]
                            ),
                        ],
                    ]
                )
                ->add(
                    'urlOnlineBallot',
                    UrlType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'URL Link to get Online Ballot',
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
                                    'max'        => 255,
                                    'maxMessage' => 'URL Link to get Online Ballot cannot exceed {{ limit }} characters.',
                                ]
                            ),
                        ],
                    ]
                )
                ->add(
                    'urlPaperBallot',
                    UrlType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'URL Link to get Pdf Ballot ',
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
                                    'max'        => 255,
                                    'maxMessage' => 'URL Link to get Pdf Ballot  cannot exceed {{ limit }} characters.',
                                ]
                            ),
                        ],
                    ]
                )
                ->add(
                    'urlPaperTrace',
                    UrlType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'URL Link to get The Hard Copy of The Ballot',
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
                                    'max'        => 255,
                                    'maxMessage' => 'URL Link to get The Hard Copy of The Ballot cannot exceed {{ limit }} characters.',
                                ]
                            ),
                        ],
                    ]
                )
                ->add(
                    'dateCast',
                    DateTimeType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'Date and Time Ballot was Cast',
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
                    'priorBallotId',
                    IntegerType::class,
                    [
                        'disabled'       => FALSE,
                        'label'          => 'Prior Ballot ID (Self Referencing)',
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
                    'data_class' => Ballot::class,
                ]
            );
        }
        
    }
    
