<?php
    
    namespace App\Form\Parts;
    
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class PartSubmitButtonAddMultipleCompanyFormType
     *
     * @package App\Form\Parts
     */
    class ButtonSubmitCompanyAddMultiple extends AbstractType
    {
    
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add(
                    'submit_and_add',
                    SubmitType::class,
                    [
	                    'label' => 'Save and Add Another',
	                    'attr'  => [
		                    'class' => 'btn btn-info btn-lg btn-block',
	                    ],
                    ]
                );
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
