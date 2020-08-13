<?php
    
    namespace App\Form;
    
    use App\Form\Model\AddressBillingFormType;
    use App\Form\Parts\AddressEmailFormType;
    use App\Form\Parts\AddressMailingFormType;
    use App\Form\Parts\AddressPhysicalFormType;
    use App\Form\Parts\AddressPropertyFormType;
    use App\Form\Parts\AssociationExternalPropertyIdFormType;
    use App\Form\Parts\AssociationInternalPropertyIdFormType;
    use App\Form\Parts\AssociationSizeInformationFormType;
    use App\Form\Parts\DescriptionLongFormType;
    use App\Form\Parts\DescriptionShortFormType;
    use App\Form\Parts\DisplayDescriptionLongFormType;
    use App\Form\Parts\LegalDescriptionCountyFormType;
    use App\Form\Parts\LegalDescriptionFullFormType;
    use App\Form\Parts\LegalDescriptionLotBlockSubFormType;
    use App\Form\Parts\LegalDescriptionSecTownRangeFormType;
    use App\Form\Parts\NameFormalFormType;
    use App\Form\Parts\NamePersonFormType;
    use App\Form\Parts\PhoneFaxFormType;
    use App\Form\Parts\PhoneHomeFormType;
    use App\Form\Parts\PhoneMobileFormType;
    use App\Form\Parts\PhoneWorkFormType;
    use App\Form\Parts\ButtonSubmitCompanyAddMultiple;
    use App\Form\Parts\ButtonSubmitGenericSaveInformation;
    use App\Form\Parts\UrlFormType;
    use App\Form\Parts\UsernameFormType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class MockFormType
     *
     * @package App\Form
     */
    class MockFormType extends AbstractType
    {
        
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                /**
                 * Name Elements
                 */
                ->add(
                    'nameFormal',
                    NameFormalFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'namePerson',
                    NamePersonFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                /**
                 * Address Elements
                 */
                ->add(
                    'physicalAddress',
                    AddressPhysicalFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'mailingAddress',
                    AddressMailingFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'billingAddress',
                    AddressBillingFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                /**
                 * Email And Username Elements
                 */
                ->add(
                    'email',
                    AddressEmailFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'username',
                    UsernameFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'password',
                    PasswordFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                /**
                 * Description Elements
                 */
                ->add(
                    'descriptionShort',
                    DescriptionShortFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'descriptionLong',
                    DescriptionLongFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'displayDescriptionLong',
                    DisplayDescriptionLongFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                /**
                 * Phone Elements
                 */
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
                /**
                 * Web Site Address Elements
                 */
                ->add(
                    'url',
                    UrlFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                /**
                 *  Association Size related to Company Elements
                 */
                ->add(
                    'associationSize',
                    AssociationSizeInformationFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                /**
                 * Property Description Elements
                 */
                ->add(
                    'internalPropertyId',
                    AssociationInternalPropertyIdFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'externalPropertyId',
                    AssociationExternalPropertyIdFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'propertyAddress',
                    AddressPropertyFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'county',
                    LegalDescriptionCountyFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'lotBlockSubdivision',
                    LegalDescriptionLotBlockSubFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'sectionTownshipRange',
                    LegalDescriptionSecTownRangeFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'legalDescription',
                    LegalDescriptionFullFormType::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                /**
                 *  Submit Button Elements
                 */
                ->add(
                    'save_and_add',
	                ButtonSubmitCompanyAddMultiple::class,
                    [
                        'data_class' => MOCK::class,
                    ]
                )
                ->add(
                    'save',
	                ButtonSubmitGenericSaveInformation::class,
                    [
                        'data_class' => MOCK::class,
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
                    'inherit_data' => TRUE,
                ]
            );
        }
        
    }
