<?php
    
    namespace App\Form;
    
    use App\Entity\Company;
    use App\Form\Parts\AddressBillingFormType;
    use App\Form\Parts\AddressMailingFormType;
    use App\Form\Parts\AddressPhysicalFormType;
    use App\Form\Parts\NameFormalFormType;
    use App\Form\Parts\PhoneFaxFormType;
    use App\Form\Parts\PhoneWorkFormType;
    use App\Form\Parts\ButtonSubmitGenericSaveInformation;
    use App\Form\Parts\UrlFormType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class CompanyFormType
     *
     * @package App\Form
     */
    class CompanyFormType extends AbstractType
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
                        'data_class' => Company::class,
                    ]
                )
                ->add(
                    'physicalAddress',
                    AddressPhysicalFormType::class,
                    [
                        'data_class' => Company::class,
                    ]
                )
                ->add('displayPhysicalAddress')
                ->add(
                    'mailingAddress',
                    AddressMailingFormType::class,
                    [
                        'data_class' => Company::class,
                    ]
                )
                ->add('displayMailingAddress')
                ->add(
                    'billingAddress',
                    AddressBillingFormType::class,
                    [
                        'data_class' => Company::class,
                    ]
                )
                ->add('displayBillingAddress')
	            ->add(
                    'phoneFax',
                    PhoneFaxFormType::class,
                    [
                        'data_class' => Company::class,
                    ]
                )
	            ->add(
                    'phoneWork',
                    PhoneWorkFormType::class,
                    [
                        'data_class' => Company::class,
                    ]
                )
	            ->add(
                    'url',
                    UrlFormType::class,
                    [
                        'data_class' => Company::class,
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
                    'data_class' => Company::class,
                ]
            );
        }
        
    }
