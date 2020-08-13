<?php
    
    namespace App\Form;
    
    use App\Entity\BallotStatus;
    use App\Form\Parts\ButtonSubmitGenericSaveInformation;
    use App\Form\Parts\DescriptionLongFormType;
    use App\Form\Parts\DescriptionShortFormType;
    use App\Form\Parts\DisplayDescriptionLongFormType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class BallotStatusFormType
     *
     * @package App\Form
     */
    class BallotStatusFormType extends AbstractType
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
                        'data_class' => BallotStatus::class,
                    ]
                )
	            ->add(
                    'descriptionLong',
                    DescriptionLongFormType::class,
                    [
                        'data_class' => BallotStatus::class,
                    ]
                )
	            ->add(
                    'displayDescriptionLong',
                    DisplayDescriptionLongFormType::class,
                    [
                        'data_class' => BallotStatus::class,
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
                    'data_class' => BallotStatus::class,
                ]
            );
        }
        
    }
