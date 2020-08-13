<?php
    
    namespace App\Form;
    
    use App\Entity\AssociationStaffPermission;
    use App\Form\Parts\ButtonSubmitGenericSaveInformation;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class PermissionFormType
     *
     * @package App\Form
     */
    class PermissionFormType extends AbstractType
    {
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
	            ->add('associationStaff')
	            ->add('permission')
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
                    'data_class' => AssociationStaffPermission::class,
                ]
            );
        }
        
    }
