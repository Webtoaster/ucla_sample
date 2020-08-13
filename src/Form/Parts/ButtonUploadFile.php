<?php
	
	namespace App\Form\Parts;
	
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	
	/**
	 * Class PartSubmitButtonAddSingleCompanyFormType
	 *
	 * @package App\Form\Parts
	 */
	class ButtonUploadFile extends AbstractType
	{
		
		/**
		 * @param  FormBuilderInterface  $builder
		 * @param  array                 $options
		 */
		public function buildForm(FormBuilderInterface $builder, array $options):void
		{
			$builder
				->add(
					'save',
					SubmitType::class,
					[
						'label' => 'Upload File',
						'attr'  => [
							'class' => 'btn btn-success btn-lg btn-block active',
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
