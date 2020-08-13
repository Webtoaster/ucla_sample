<?php
	
	namespace App\Form\Parts;
	
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\HiddenType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	
	/**
	 * Class ImportLoginFormType
	 *
	 * @package App\Form\Parts
	 */
	class TEMPLATE_HIDDEN_TYPES extends AbstractType
	{
		/**
		 * {@inheritdoc}
		 */
		public function buildForm(FormBuilderInterface $builder, array $options):void
		{
			
			
			// Hidden Fields
			$builder
				->add('Name_HiddenType',
					HiddenType::class,
					[
						'trim' => TRUE,
					]
				);
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function configureOptions(OptionsResolver $resolver):void
		{
			$resolver->setDefaults([
					'inherit_data' => TRUE,
				]
			);
		}
	}
