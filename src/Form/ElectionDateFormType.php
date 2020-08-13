<?php
    
    namespace App\Form;
    
    use App\Entity\ElectionDate;
    use App\Form\Parts\ButtonSubmitGenericSaveInformation;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class ElectionDateFormType
     *
     * @package App\Form
     */
    class ElectionDateFormType extends AbstractType
    {
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
	            ->add('dateValue')
	            ->add('descriptionShort')
	            ->add('descriptionLong')
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
                    'data_class' => ElectionDate::class,
                ]
            );
        }
        
    }
