<?php
    
    namespace App\Form;
    
    use App\Entity\Property;
    use App\Form\Parts\AddressPropertyFormType;
    use App\Form\Parts\AssociationExternalPropertyIdFormType;
    use App\Form\Parts\AssociationInternalPropertyIdFormType;
    use App\Form\Parts\ButtonSubmitGenericSaveInformation;
    use App\Form\Parts\LegalDescriptionCountyFormType;
    use App\Form\Parts\LegalDescriptionFullFormType;
    use App\Form\Parts\LegalDescriptionLotBlockSubFormType;
    use App\Form\Parts\LegalDescriptionSecTownRangeFormType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class PropertyFormType
     *
     * @package App\Form
     */
    class PropertyFormType extends AbstractType
    {
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
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
                    'data_class' => Property::class,
                
                ]
            );
        }
        
    }
