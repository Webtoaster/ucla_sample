<?php
    
    namespace App\Form\HOLD;
    
    use App\Entity\Company;
    use App\Form\Parts\AddressMailingFormType;
    use App\Form\Parts\AddressPhysicalFormType;
    use App\Form\Parts\AssociationSizeInformationFormType;
    use App\Form\Parts\NameFormalFormType;
    use App\Form\Parts\PhoneFaxFormType;
    use App\Form\Parts\PhoneWorkFormType;
    use App\Form\Parts\UrlFormType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class CompanyType
     *
     * @package App\Form
     */
    class CompanyType extends AbstractType
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
                ->add(
                    'mailingAddress',
                    AddressMailingFormType::class,
                    [
                        'data_class' => Company::class,
                    ]
                )
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
                ->add(
                    'associationSize',
                    AssociationSizeInformationFormType::class,
                    [
                        'data_class' => Company::class,
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
                    'data_class'         => Company::class,
                    'allow_extra_fields' => TRUE,
                    
                    //    'validation_groups' => ['new_company'],
                ]
            );
        }
        
    }
    
