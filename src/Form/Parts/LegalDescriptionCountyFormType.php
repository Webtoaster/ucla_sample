<?php
	
	namespace App\Form\Parts;
	
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	
	/**
	 * Class LegalDescriptionCountyFormType
	 *
	 * @package App\Form\Parts
	 */
	
	/**
	 * Class LegalDescriptionCountyFormType
	 *
	 * @package App\Form\Parts
	 */
	class LegalDescriptionCountyFormType extends AbstractType
	{
		
		
		/**
		 * @param  FormBuilderInterface  $builder
		 * @param  array                 $options
		 */
		public function buildForm(FormBuilderInterface $builder, array $options):void
		{
			$builder
				->add('county',
					TextType::class,
					[
						// 'attr'           => ['class' => ''],
						// 'data'           => '',
						'disabled' => FALSE,
						// 'required'       => FALSE,
						// 'empty_data'     => 'John Doe',
						// 'error_bubbling' => FALSE,
						// 'error_mapping'  => [],
						'help'     => 'County or Parrish of Property',
						// 'help_attr'      => [],
						// 'help_html'      => FALSE,
						'label'    => 'County',
						// 'label_attr'     => [],
						// 'label_format'   => NULL,
						'mapped'   => TRUE,
						// 'row_attr'       => [],
						'trim'     => TRUE,
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
