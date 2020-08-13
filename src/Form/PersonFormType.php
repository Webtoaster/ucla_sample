<?php
    
    namespace App\Form;
    
    use App\Entity\Person;
    use App\Entity\PersonType;
    use App\Form\Parts\AddressEmailFormType;
    use App\Form\Parts\AddressMailingFormType;
    use App\Form\Parts\AddressPhysicalFormType;
    use App\Form\Parts\ButtonSubmitGenericSaveInformation;
    use App\Form\Parts\NameFormalFormType;
    use App\Form\Parts\NamePersonFormType;
    use App\Form\Parts\PersonTypeFormType;
    use App\Form\Parts\PhoneHomeFormType;
    use App\Form\Parts\PhoneMobileFormType;
    use App\Form\Parts\PhoneWorkFormType;
    use App\Form\Parts\ButtonSubmitUserNew;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;
    use Symfony\Component\Validator\Constraints\Regex;
    
    /**
     * Class PersonFormType
     *
     * @package App\Form
     */
    class PersonFormType extends AbstractType
    {
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add(
                    'nameFormal',
                    NameFormalFormType::class,
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
                    'personType',
                    PersonTypeFormType::class,
                    [
                        'data_class' => Person::class,
                    ]
                )
                // ->add(
                //     'plainPassword',
                //     PasswordFormType::class,
                //     [
                //         'data_class' => Person::class,
                //     ]
                // )
                
                ->add(
                    'plainPassword',
                    RepeatedType::class,
                    [
                        'type'            => PasswordType::class,
                        'invalid_message' => 'Your password does not match the confirmation.',
                        'mapped'          => FALSE,
                        'options'         => ['attr' => ['class' => 'password-field']],
                        'required'        => TRUE,
                        'constraints'     => [
                            new NotBlank(
                                [
                                    'message' => 'Please enter a password',
                                ]
                            ),
                            new Length(
                                [
                                    'min'        => 6,
                                    'minMessage' => 'Your password should be at least {{ limit }} characters',
                                    'max'        => 4096,
                                ]
                            ),
                            new Regex(
                                [
                                    'pattern' => '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\d\s:])([^\s]){8,16}$/s',
                                    'match'   => TRUE,
                                    'message' => 'Please enter a valid password.  See the requirements below.',
                                ]
                            ),
                        ],
                        'first_options'   => [
                            'label'     => 'Password',
                            'help'      => 'Password must contain 1 number (0-9).<br/>
										Password must contain 1 uppercase letter.<br/>
										Password must contain 1 lowercase letter.<br/>
										Password must contain 1 non-alpha numeric character.<br/>
										Password must be between 6-16 characters without spaces.<br/>',
                            'help_html' => TRUE,
                            'attr'      => ['class' => NULL,],
                        ],
                        'second_options'  => [
                            'label' => 'Confirm Password',
                            'help'  => 'Please enter your Password again.',
                            'attr'  => ['class' => NULL,],
                        ],
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
                    'mailingAddress',
                    AddressMailingFormType::class,
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
                    'phoneWork',
                    PhoneWorkFormType::class,
                    [
                        'data_class' => Person::class,
                    ]
                )
                ->add('save',
	                ButtonSubmitGenericSaveInformation::class,
	                [
		                'mapped' => FALSE,
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
