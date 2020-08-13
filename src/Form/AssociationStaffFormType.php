<?php
    
    namespace App\Form;
    
    use App\Entity\AssociationStaff;
    use App\Form\Parts\ButtonSubmitGenericSaveInformation;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class AssociationStaffFormType
     *
     * @package App\Form
     */
    class AssociationStaffFormType extends AbstractType
    {
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
	            ->add('jobTitle')
	            ->add('dateStart')
	            ->add('dateEnd')
	            ->add('isAttorney')
	            ->add('isBoardMember')
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
                    'data_class' => AssociationStaff::class,
                ]
            );
        }
        
    }
