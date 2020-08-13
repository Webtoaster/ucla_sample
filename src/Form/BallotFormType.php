<?php
    
    namespace App\Form;
    
    use App\Entity\Ballot;
    use App\Form\Parts\ButtonSubmitGenericSaveInformation;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class BallotFormType
     *
     * @package App\Form
     */
    class BallotFormType extends AbstractType
    {
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
	            ->add('proxyKey')
	            ->add('race')
	            ->add('election')
	            ->add('owner')
	            ->add('ballotStatus')
	            ->add('proxy')
	            ->add('proxyStatus')
	            ->add('property')
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
                    'data_class' => Ballot::class,
                ]
            );
        }
        
    }
