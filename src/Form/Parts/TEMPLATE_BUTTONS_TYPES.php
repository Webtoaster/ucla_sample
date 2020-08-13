<?php
	
	namespace App\Form\Parts;
	
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\ButtonType;
	use Symfony\Component\Form\Extension\Core\Type\ResetType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	
	/**
	 * Class ImportLoginFormType
	 *
	 * @package App\Form\Parts
	 */
	class TEMPLATE_BUTTONS_TYPES extends AbstractType
	{
		/**
		 * {@inheritdoc}
		 */
		public function buildForm(FormBuilderInterface $builder, array $options):void
		{
			
			
			// Buttons
			$builder
				->add('Name_ButtonType',
					ButtonType::class,
					[
						// 'attr'           => ['class' => ''],
						// 'data'           => '',
						'disabled' => FALSE,
						// 'required'       => FALSE,
						// 'empty_data'     => 'John Doe',
						// 'error_bubbling' => FALSE,
						// 'error_mapping'  => [],
						// 'help'           => '',
						// 'help_attr'      => [],
						// 'help_html'      => FALSE,
						'label'    => '',
						// 'label_attr'     => [],
						// 'label_format'   => NULL,
						'mapped'   => TRUE,
						// 'row_attr'       => [],
						'trim'     => TRUE,
					]
				)
				->add('Name_ResetType',
					ResetType::class,
					[
						// 'attr'           => ['class' => ''],
						// 'data'           => '',
						'disabled' => FALSE,
						// 'required'       => FALSE,
						// 'empty_data'     => 'John Doe',
						// 'error_bubbling' => FALSE,
						// 'error_mapping'  => [],
						// 'help'           => '',
						// 'help_attr'      => [],
						// 'help_html'      => FALSE,
						'label'    => '',
						// 'label_attr'     => [],
						// 'label_format'   => NULL,
						'mapped'   => TRUE,
						// 'row_attr'       => [],
						'trim'     => TRUE,
					]
				)
				->add('Name_SubmitType',
					SubmitType::class,
					[
						// 'attr'           => ['class' => ''],
						// 'data'           => '',
						'disabled' => FALSE,
						// 'required'       => FALSE,
						// 'empty_data'     => 'John Doe',
						// 'error_bubbling' => FALSE,
						// 'error_mapping'  => [],
						// 'help'           => '',
						// 'help_attr'      => [],
						// 'help_html'      => FALSE,
						'label'    => '',
						// 'label_attr'     => [],
						// 'label_format'   => NULL,
						'mapped'   => TRUE,
						// 'row_attr'       => [],
						'trim'     => TRUE,
					]
				)
			;
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
