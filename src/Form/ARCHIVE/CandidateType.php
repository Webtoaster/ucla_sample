<?php
    
    namespace App\Form\ARCHIVE;

    use App\Entity\Candidate;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\NotBlank;

    /**
     * Class CandidateType
     *
     * @package App\Form
     */

    /**
     * Class CandidateType
     *
     * @package App\Form
     */
    class CandidateType extends AbstractType
    {

        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add(
                'candidateId',
                IntegerType::class,
                [
                  'disabled'       => true,
                  'label'          => 'Primary Key to Candidate',
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
                'isWriteIn',
                ChoiceType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Is a Write in Vote',
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
                        'message' => 'Please enter a Is a Write in Vote ',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'writeInByVoterId',
                TextType::class,
                [
                  'disabled'       => true,
                  'label'          => 'Foreign Key to Voter',
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
                'nameDisplay',
                PartNameDisplayFormType::class,
                [
                  'data_class' => Candidate::class,
                ]
              )
              ->add(
                'name',
                PartNamePersonFormType::class,
                [
                  'data_class' => Candidate::class,
                ]
              )
              ->add(
                'candidateAddress',
                PartAddressPhysicalFormType::class,
                [
                  'data_class' => Candidate::class,
                ]
              )
              ->add(
                'phoneMobile',
                PartPhoneMobileFormType::class,
                [
                  'data_class' => Candidate::class,
                ]
              )
              ->add(
                'emailAddress',
                PartAddressEmailFormType::class,
                [
                  'data_class' => Candidate::class,
                ]
              )
              ->add(
                'displayCandidateAddress',
                ChoiceType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Display The Candidates Address',
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
                        'message' => 'Please enter a Display The Candidates Address ',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'shareWriteInName',
                ChoiceType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Does The Voter Want to Share The Name of The Write in They Have Entered',
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
                        'message' => 'Please enter a Does The Voter Want to Share The Name of The Write in They Have Entered ',
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
                'data_class' => Candidate::class,
              ]
            );
        }

    }
