<?php
	
	namespace App\Form\Parts;
	
	use Symfony\Bridge\Doctrine\Form\Type\EntityType;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
	use Symfony\Component\Form\Extension\Core\Type\CountryType;
	use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
	use Symfony\Component\Form\Extension\Core\Type\LanguageType;
	use Symfony\Component\Form\Extension\Core\Type\LocaleType;
	use Symfony\Component\Form\Extension\Core\Type\TimezoneType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	
	/**
	 * Class ImportLoginFormType
	 *
	 * @package App\Form\Parts
	 */
	class TEMPLATE_CHOICE_TYPES extends AbstractType
	{
		/**
		 * {@inheritdoc}
		 */
		public function buildForm(FormBuilderInterface $builder, array $options):void
		{
			
			
			// Choice Fields
			$builder
				->add('Name_ChoiceType',
					ChoiceType::class,
					[
						'choices'  => [],
						'expanded' => FALSE,
						'multiple' => FALSE,
						// 'attr'           => ['class' => ''],
						// 'data'           => '',
						'disabled' => FALSE,
						// 'required'       => FALSE,
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
				->add('Name_EntityType',
					EntityType::class,
					[
						'choices'  => [],
						'expanded' => FALSE,
						'multiple' => FALSE,
						// 'data_class'=>''
						// 'attr'           => ['class' => ''],
						// 'data'           => '',
						'disabled' => FALSE,
						// 'required'       => FALSE,
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
				->add('Name_CountryType',
					CountryType::class,
					[
						'choices'  => [],
						'expanded' => FALSE,
						'multiple' => FALSE,
						// 'attr'           => ['class' => ''],
						// 'data'           => '',
						'disabled' => FALSE,
						// 'required'       => FALSE,
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
				->add('Name_LanguageType',
					LanguageType::class,
					[
						'choices'  => [],
						'expanded' => FALSE,
						'multiple' => FALSE,
						// 'attr'           => ['class' => ''],
						// 'data'           => '',
						'disabled' => FALSE,
						// 'required'       => FALSE,
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
				->add('Name_LocaleType',
					LocaleType::class,
					[
						'choices'  => [],
						'expanded' => FALSE,
						'multiple' => FALSE,
						// 'attr'           => ['class' => ''],
						// 'data'           => '',
						'disabled' => FALSE,
						// 'required'       => FALSE,
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
				->add('Name_TimezoneType',
					TimezoneType::class,
					[
						'choices'  => [],
						'expanded' => FALSE,
						'multiple' => FALSE,
						// 'attr'           => ['class' => ''],
						// 'data'           => '',
						'disabled' => FALSE,
						// 'required'       => FALSE,
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
				->add('Name_CurrencyType',
					CurrencyType::class,
					[
						'choices'  => [],
						'expanded' => FALSE,
						'multiple' => FALSE,
						// 'attr'           => ['class' => ''],
						// 'data'           => '',
						'disabled' => FALSE,
						// 'required'       => FALSE,
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
