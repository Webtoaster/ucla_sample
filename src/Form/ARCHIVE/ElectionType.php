<?php
    
    namespace App\Form\ARCHIVE;

    use App\Entity\Election;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\UrlType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;

    /**
     * Class ElectionType
     *
     * @package App\Form
     */
    class ElectionType extends AbstractType
    {

        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add(
                'electionId',
                IntegerType::class,
                [
                  'disabled'       => true,
                  'label'          => 'Primary Key to Election',
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
                'electionTypeId',
                TextType::class,
                [
                  'disabled'       => true,
                  'label'          => 'Foreign Key to Election_Type',
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
                'electionNameHeading',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Election Description Heading',
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
                        'message' => 'Please enter a Election Description Heading ',
                      ]
                    ),
                    new Length(
                      [
                        'min'        => 1,
                        'minMessage' => 'Election Description Heading must be at least {{ limit }} characters in length.',
                        'max'        => 128,
                        'maxMessage' => 'Election Description Heading cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'electionNameSubheading',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Election Description Sub-Heading',
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
                        'maxMessage' => 'Election Description Sub-Heading cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'urlElection',
                UrlType::class,
                [
                  'disabled'       => false,
                  'label'          => 'URL Link to get to Page Describing The Election',
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
                        'maxMessage' => 'URL Link to get to Page Describing The Election cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'htmlElectionInformation',
                TextareaType::class,
                [
                  'disabled'       => false,
                  'label'          => 'HTML Describing The Election',
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
                        'message' => 'Please enter a HTML Describing The Election ',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'ballotPhysicalAddressLine1',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Address Line 1',
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
                        'message' => 'Please enter a Address Line 1 ',
                      ]
                    ),
                    new Length(
                      [
                        'min'        => 1,
                        'minMessage' => 'Address Line 1 must be at least {{ limit }} characters in length.',
                        'max'        => 128,
                        'maxMessage' => 'Address Line 1 cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'ballotPhysicalAddressLine2',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Address Line 2',
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
                        'maxMessage' => 'Address Line 2 cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'ballotPhysicalAddressCity',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'City',
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
                        'message' => 'Please enter a City ',
                      ]
                    ),
                    new Length(
                      [
                        'min'        => 1,
                        'minMessage' => 'City must be at least {{ limit }} characters in length.',
                        'max'        => 128,
                        'maxMessage' => 'City cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'ballotPhysicalAddressState',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'State',
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
                        'message' => 'Please enter a State ',
                      ]
                    ),
                    new Length(
                      [
                        'min'        => 1,
                        'minMessage' => 'State must be at least {{ limit }} characters in length.',
                        'max'        => 2,
                        'maxMessage' => 'State cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'ballotPhysicalAddressZipCode',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Zip Code',
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
                        'message' => 'Please enter a Zip Code ',
                      ]
                    ),
                    new Length(
                      [
                        'min'        => 1,
                        'minMessage' => 'Zip Code must be at least {{ limit }} characters in length.',
                        'max'        => 16,
                        'maxMessage' => 'Zip Code cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'displayPhysicalAddress',
                ChoiceType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Display The Physical Address',
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
                    new NotBlank(['message' => 'Please enter a Display The Physical Address ',]),
                  ],
                ]
              )
              ->add(
                'ballotMailingAddressLine1',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Address Line 1',
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
                    new NotBlank(['message' => 'Please enter a Address Line 1 ',]),
                    new Length(
                      [
                        'min'        => 1,
                        'minMessage' => 'Address Line 1 must be at least {{ limit }} characters in length.',
                        'max'        => 128,
                        'maxMessage' => 'Address Line 1 cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'ballotMailingAddressLine2',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Address Line 2',
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
                        'maxMessage' => 'Address Line 2 cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'ballotMailingAddressCity',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'City',
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
                    new NotBlank(['message' => 'Please enter a City ',]),
                    new Length(
                      [
                        'min'        => 1,
                        'minMessage' => 'City must be at least {{ limit }} characters in length.',
                        'max'        => 128,
                        'maxMessage' => 'City cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'ballotMailingAddressState',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'State',
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
                    new NotBlank(['message' => 'Please enter a State ',]),
                    new Length(
                      [
                        'min'        => 1,
                        'minMessage' => 'State must be at least {{ limit }} characters in length.',
                        'max'        => 2,
                        'maxMessage' => 'State cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'ballotMailingAddressZipCode',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Zip Code',
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
                    new NotBlank(['message' => 'Please enter a Zip Code ',]),
                    new Length(
                      [
                        'min'        => 1,
                        'minMessage' => 'Zip Code must be at least {{ limit }} characters in length.',
                        'max'        => 16,
                        'maxMessage' => 'Zip Code cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'displayMailingAddress',
                ChoiceType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Display The Mailing Address',
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
                    new NotBlank(['message' => 'Please enter a Display The Mailing Address ',]),
                  ],
                ]
              )
              ->add(
                'votesMin',
                IntegerType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Minimum Number of Votes that can be Cast',
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
                    new NotBlank(['message' => 'Please enter a Minimum Number of Votes that can be Cast ',]),
                  ],
                ]
              )
              ->add(
                'votesMax',
                IntegerType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Maximum Number of Votes that can be Cast',
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
                    new NotBlank(['message' => 'Please enter a Maximum Number of Votes that can be Cast ',]),
                  ],
                ]
              )
              ->add(
                'dateStart',
                DateTimeType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Date and Time When Voting Starts',
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
                    new NotBlank(['message' => 'Please enter a Date and Time When Voting Starts ',]),
                  ],
                ]
              )
              ->add(
                'dateEnd',
                DateTimeType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Date and Time When Voting Ends',
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
                    new NotBlank(['message' => 'Please enter a Date and Time When Voting Ends ',]),
                  ],
                ]
              )
              ->add(
                'votersTotal',
                IntegerType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Total Number of Voters.',
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
                    new NotBlank(['message' => 'Please enter a Total Number of Voters. ',]),
                  ],
                ]
              )
              ->add(
                'votersRequiredElection',
                IntegerType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Total Number of Votes Required to Make This Election Official',
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
                    new NotBlank(['message' => 'Please enter a Total Number of Votes Required to Make This Election Official ',]),
                  ],
                ]
              )
              ->add(
                'votersRequiredRatification',
                IntegerType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Number of Voters Required to Ratify a Bylaw Or a Deed Restriction',
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
                    new NotBlank(['message' => 'Please enter a Number of Voters Required to Ratify a Bylaw Or a Deed Restriction ',]),
                  ],
                ]
              )
              ->add(
                'votesMinPerBylaws',
                IntegerType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Minimum Number of Votes that can be Cast per Bylaws',
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
                    new NotBlank(['message' => 'Please enter a Minimum Number of Votes that can be Cast per Bylaws ',]),
                  ],
                ]
              )
              ->add(
                'votesMinPerStatute',
                IntegerType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Minimum Number of Votes that can be Cast per Statute',
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
                    new NotBlank(['message' => 'Please enter a Minimum Number of Votes that can be Cast per Statute ',]),
                  ],
                ]
              )
              ->add(
                'electionState',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'State',
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
                    new NotBlank(['message' => 'Please enter a State ',]),
                    new Length(
                      [
                        'min'        => 1,
                        'minMessage' => 'State must be at least {{ limit }} characters in length.',
                        'max'        => 2,
                        'maxMessage' => 'State cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'allowWriteInCandidates',
                ChoiceType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Will You Allow Write in Candidates?',
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
                'allowProxyVoting',
                ChoiceType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Will You Allow Proxy Voting?',
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
                'allowProxyDirected',
                ChoiceType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Will This Election Use Directed Proxies?',
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
                'allowProxyNondirected',
                ChoiceType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Will This Election Use Non-Directed Proxies?',
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
            ;
        }

        /**
         * {@inheritdoc}
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
                'data_class' => Election::class,
              ]
            );
        }

    }






    //            ->add('electionNameHeading')
    //            ->add('electionNameSubheading')
    //            ->add('urlElection')
    //            ->add('htmlElectionInformation')
    //            ->add('ballotPhysicalAddressLine1')
    //            ->add('ballotPhysicalAddressLine2')
    //            ->add('ballotPhysicalAddressCity')
    //            ->add('ballotPhysicalAddressState')
    //            ->add('ballotPhysicalAddressZipCode')
    //            ->add('displayPhysicalAddress')
    //            ->add('ballotMailingAddressLine1')
    //            ->add('ballotMailingAddressLine2')
    //            ->add('ballotMailingAddressCity')
    //            ->add('ballotMailingAddressState')
    //            ->add('ballotMailingAddressZipCode')
    //            ->add('displayMailingAddress')
    //            ->add('votesMin')
    //            ->add('votesMax')
    //            ->add('dateStart')
    //            ->add('dateEnd')
    //            ->add('votersTotal')
    //            ->add('votersRequiredElection')
    //            ->add('votersRequiredRatification')
    //            ->add('electionState')
    //            ->add('allowWriteInCandidates')
    //            ->add('allowProxyVoting')
    //            ->add('allowProxyDirected')
    //            ->add('allowProxyNondirected')
    //            ->add('updatedAt')
    //            ->add('createdAt')
    //            ->add('isActive')
    //            ->add('association')
    //            ->add('electionType')
