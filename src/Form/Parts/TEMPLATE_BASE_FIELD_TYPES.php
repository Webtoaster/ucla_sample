<?php
	
	namespace App\Form\Parts;
	
	use Symfony\Bridge\Doctrine\Form\Type\EntityType;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
	use Symfony\Component\Form\Extension\Core\Type\ButtonType;
	use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
	use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
	use Symfony\Component\Form\Extension\Core\Type\CollectionType;
	use Symfony\Component\Form\Extension\Core\Type\ColorType;
	use Symfony\Component\Form\Extension\Core\Type\CountryType;
	use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
	use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
	use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
	use Symfony\Component\Form\Extension\Core\Type\DateType;
	use Symfony\Component\Form\Extension\Core\Type\EmailType;
	use Symfony\Component\Form\Extension\Core\Type\FileType;
	use Symfony\Component\Form\Extension\Core\Type\FormType;
	use Symfony\Component\Form\Extension\Core\Type\HiddenType;
	use Symfony\Component\Form\Extension\Core\Type\IntegerType;
	use Symfony\Component\Form\Extension\Core\Type\LanguageType;
	use Symfony\Component\Form\Extension\Core\Type\LocaleType;
	use Symfony\Component\Form\Extension\Core\Type\MoneyType;
	use Symfony\Component\Form\Extension\Core\Type\NumberType;
	use Symfony\Component\Form\Extension\Core\Type\PasswordType;
	use Symfony\Component\Form\Extension\Core\Type\PercentType;
	use Symfony\Component\Form\Extension\Core\Type\RadioType;
	use Symfony\Component\Form\Extension\Core\Type\RangeType;
	use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
	use Symfony\Component\Form\Extension\Core\Type\ResetType;
	use Symfony\Component\Form\Extension\Core\Type\SearchType;
	use Symfony\Component\Form\Extension\Core\Type\SubmitType;
	use Symfony\Component\Form\Extension\Core\Type\TelType;
	use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\Extension\Core\Type\TimeType;
	use Symfony\Component\Form\Extension\Core\Type\TimezoneType;
	use Symfony\Component\Form\Extension\Core\Type\UrlType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	
	/**
	 * Class ImportLoginFormType
	 *
	 * @package App\Form\Parts
	 */
	class TEMPLATE_BASE_FIELD_TYPES extends AbstractType
	{
		/**
		 * {@inheritdoc}
		 */
		public function buildForm(FormBuilderInterface $builder, array $options):void
		{
			
			
			// Base Fields - Never Used
			$builder
				->add('Name_FormType',
					FormType::class,
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
