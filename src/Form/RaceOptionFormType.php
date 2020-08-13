<?php
    
    namespace App\Form;
    
    use App\Entity\RaceOption;
    use App\Form\Parts\AddressEmailFormType;
    use App\Form\Parts\AddressMailingFormType;
    use App\Form\Parts\AddressPhysicalFormType;
    use App\Form\Parts\ButtonSubmitGenericSaveInformation;
    use App\Form\Parts\DescriptionShortFormType;
    use App\Form\Parts\NameFormalFormType;
    use App\Form\Parts\NamePersonFormType;
    use App\Form\Parts\PhoneFaxFormType;
    use App\Form\Parts\PhoneHomeFormType;
    use App\Form\Parts\PhoneMobileFormType;
    use App\Form\Parts\PhoneWorkFormType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class RaceOptionFormType
     *
     * @package App\Form
     */
    class RaceOptionFormType extends AbstractType
    {
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add(
                    'descriptionShort',
                    DescriptionShortFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'nameFormal',
                    NameFormalFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'name',
                    NamePersonFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'email',
                    AddressEmailFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'phoneHome',
                    PhoneHomeFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'phoneMobile',
                    PhoneMobileFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'phoneFax',
                    PhoneFaxFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'phoneWork',
                    PhoneWorkFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
	            ->add(
                    'physicalAddress',
                    AddressPhysicalFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
	            ->add('displayPhysicalAddress')
	            ->add(
                    'mailingAddress',
                    AddressMailingFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
	            ->add('displayMailingAddress')
	            ->add('isPerson')
	            ->add('isWriteIn')
	            ->add('shareWriteIn')
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
                    'data_class' => RaceOption::class,
                ]
            );
        }
        
    }
