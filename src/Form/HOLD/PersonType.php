<?php
    
    namespace App\Form\HOLD;

    use App\Entity\Person;
    use App\Form\Parts\AddressEmailFormType;
    use App\Form\Parts\AddressMailingFormType;
    use App\Form\Parts\AddressPhysicalFormType;
    use App\Form\Parts\NameDisplayFormType;
    use App\Form\Parts\NamePersonFormType;
    use App\Form\Parts\PhoneFaxFormType;
    use App\Form\Parts\PhoneHomeFormType;
    use App\Form\Parts\PhoneMobileFormType;
    use App\Form\Parts\PhoneWorkFormType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;

    /**
     * Class PersonType
     *
     * @package App\Form
     */
    class PersonType extends AbstractType
    {

        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add(
                'nameDisplay',
                  NameDisplayFormType::class,
                [
                  'data_class' => Person::class,
                ]
              )
              ->add(
                'name',
                  NamePersonFormType::class,
                [
                  'data_class' => Person::class,
                ]
              )
              ->add(
                'phoneHome',
                  PhoneHomeFormType::class,
                [
                  'data_class' => Person::class,
                ]
              )
              ->add(
                'phoneMobile',
                  PhoneMobileFormType::class,
                [
                  'data_class' => Person::class,
                ]
              )
              ->add(
                'phoneFax',
                  PhoneFaxFormType::class,
                [
                  'data_class' => Person::class,
                ]
              )
              ->add(
                'phoneWork',
                  PhoneWorkFormType::class,
                [
                  'data_class' => Person::class,
                ]
              )

              ->add(
                'email',
                  AddressEmailFormType::class,
                [
                  'data_class' => Person::class,
                ]
              )
              ->add(
                'roles',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Roles User Holds',
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
                        'max'        => 4294967295,
                        'maxMessage' => 'Roles User Holds cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'mailingAddress',
                  AddressMailingFormType::class,
                [
                  'data_class' => Person::class,
                ]
              )
              ->add(
                'physicalAddress',
                  AddressPhysicalFormType::class,
                [
                  'data_class' => Person::class,
                ]
              )
              ->add(
                'verificationDate',
                DateTimeType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Verification Date of Email',
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
                'isVerified',
                ChoiceType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Is Email Address Verified',
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
                        'message' => 'Please enter a Is Email Address Verified ',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'isRegistered',
                ChoiceType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Is Person Registered',
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
                        'message' => 'Please enter a Is Person Registered '
                        ,
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
                'data_class' => Person::class,
              ]
            );
        }

    }

    //            ->add('nameDisplay')
    //            ->add('nameFirst')
    //            ->add('nameMiddle')
    //            ->add('nameLast')
    //            ->add('nameSuffix')
    //            ->add('phoneHome')
    //            ->add('phoneMobile')
    //            ->add('phoneFax')
    //            ->add('phoneWork')
    //            ->add('phoneWorkExtension')
    //            ->add('email')
    //            ->add('mailingAddressLine1')
    //            ->add('mailingAddressLine2')
    //            ->add('mailingAddressCity')
    //            ->add('mailingAddressState')
    //            ->add('mailingAddressZipCode')
    //            ->add('mailingAddressCountry')
    //            ->add('physicalAddressLine1')
    //            ->add('physicalAddressLine2')
    //            ->add('physicalAddressCity')
    //            ->add('physicalAddressState')
    //            ->add('physicalAddressZipCode')
    //            ->add('password')
    //            ->add('passwordRecoveryKey')
    //            ->add('passwordRecoveryDate')
    //            ->add('passwordRecoveryIpAddress')
    //            ->add('ipAddress')
    //            ->add('roles')
    //            ->add('verificationKey')
    //            ->add('verificationDate')
    //            ->add('verificationIpAddress')
    //            ->add('updatedAt')
    //            ->add('createdAt')
    //            ->add('hasStartedRegistration')
    //            ->add('isActive')
    //            ->add('isVerified')
    //            ->add('isRegistered')
    //            ->add('agreedToTermsAt')
    //            ->add('termsId')
