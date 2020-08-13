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
	class ButtonSubmitGenericSaveInformation extends AbstractType
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
						'label' => 'Save Information',
						'attr'  => [
							'class' => 'btn btn-success btn-lg btn-block',
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
