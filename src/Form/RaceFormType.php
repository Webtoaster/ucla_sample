<?php
    
    namespace App\Form;
    
    use App\Entity\Race;
    use App\Form\Parts\ButtonSubmitGenericSaveInformation;
    use App\Form\Parts\DescriptionLongFormType;
    use App\Form\Parts\DescriptionShortFormType;
    use App\Form\Parts\DisplayDescriptionLongFormType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class RaceFormType
     *
     * @package App\Form
     */
    class RaceFormType extends AbstractType
    {
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add('heading')
                ->add('subheading')
                ->add('selectMin')
                ->add('selectMax')
                ->add('formType')
                ->add('allowForQuorum')
                ->add('allowForAbstain')
                ->add('displayMethod')
                ->add('displayIncumbency')
                ->add('displayDeclared')
                ->add('displayWriteIn')
                ->add('displayRandom')
                ->add('sortOrder')
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
                    'data_class' => Race::class,
                ]
            );
        }
        
    }
