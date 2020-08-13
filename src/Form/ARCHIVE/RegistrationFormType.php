<?php
    
    namespace App\Form\ARCHIVE;

    use App\Entity\Person;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\PasswordType;
    use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;
    use Symfony\Component\Validator\Constraints\Regex;

    /**
     * Class RegistrationFormType
     *
     * @package App\Form
     */
    class RegistrationFormType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add('name', PartNamePersonFormType::class)
              ->add('phoneHome', PartPhoneHomeFormType::class)
              ->add('phoneMobile', PartPhoneMobileFormType::class)
              ->add('phoneWork', PartPhoneWorkFormType::class)
              ->add('email', PartAddressEmailFormType::class)
              ->add(
                'plainPassword',
                RepeatedType::class,
                [
                  'type'            => PasswordType::class,
                  'invalid_message' => 'Your password does not match the confirmation.',
                  'mapped'          => false,
                  'options'         => ['attr' => ['class' => 'password-field']],
                  'required'        => true,
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
                        'match'   => true,
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
                    'help_html' => true,
                    'attr'      => ['class' => null,],
                  ],
                  'second_options'  => [
                    'label' => 'Confirm Password',
                    'help'  => 'Please enter your Password again.',
                    'attr'  => ['class' => null,],
                  ],
                ]
              )
            ;
        }

        /**
         * @param  OptionsResolver  $resolver
         *
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
