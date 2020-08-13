<?php
	
	namespace App\Form\Parts;
	
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\ColorType;
	use Symfony\Component\Form\Extension\Core\Type\EmailType;
	use Symfony\Component\Form\Extension\Core\Type\IntegerType;
	use Symfony\Component\Form\Extension\Core\Type\MoneyType;
	use Symfony\Component\Form\Extension\Core\Type\NumberType;
	use Symfony\Component\Form\Extension\Core\Type\PasswordType;
	use Symfony\Component\Form\Extension\Core\Type\PercentType;
	use Symfony\Component\Form\Extension\Core\Type\RangeType;
	use Symfony\Component\Form\Extension\Core\Type\SearchType;
	use Symfony\Component\Form\Extension\Core\Type\TelType;
	use Symfony\Component\Form\Extension\Core\Type\TextareaType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\Extension\Core\Type\UrlType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	
	/**
	 * Class ImportLoginFormType
	 *
	 * @package App\Form\Parts
	 */
	class AccountNumbers extends AbstractType
	{
		/**
		 * {@inheritdoc}
		 */
		public function buildForm(FormBuilderInterface $builder, array $options):void
		{
			
			// Text Fields
			$builder
				->add('externalAccountId',
					TextType::class,
					[
						// 'attr'           => ['class' => ''],
						// 'data'           => '',
						'disabled' => FALSE,
						// 'required'       => FALSE,
						// 'empty_data'     => 'John Doe',
						// 'error_bubbling' => FALSE,
						// 'error_mapping'  => [],
						'help'     => 'This ID normally comes from a County Appraisal District or Taxing authority.',
						// 'help_attr'      => [],
						// 'help_html'      => FALSE,
						'label'    => 'External Account ID',
						// 'label_attr'     => [],
						// 'label_format'   => NULL,
						'mapped'   => TRUE,
						// 'row_attr'       => [],
						'trim'     => TRUE,
					]
				)
				->add('internalAccountId',
					TextType::class,
					[
						// 'attr'           => ['class' => ''],
						// 'data'           => '',
						'disabled' => FALSE,
						// 'required'       => FALSE,
						// 'empty_data'     => 'John Doe',
						// 'error_bubbling' => FALSE,
						// 'error_mapping'  => [],
						'help'     => 'This is is the Top Level Account ID from your Association Management Software.',
						// 'help_attr'      => [],
						// 'help_html'      => FALSE,
						'label'    => 'Internal Account ID',
						// 'label_attr'     => [],
						// 'label_format'   => NULL,
						'mapped'   => TRUE,
						// 'row_attr'       => [],
						'trim'     => TRUE,
					]
				)
				->add('internalOwnerId',
					TextType::class,
					[
						// 'attr'           => ['class' => ''],
						// 'data'           => '',
						'disabled' => FALSE,
						// 'required'       => FALSE,
						// 'empty_data'     => 'John Doe',
						// 'error_bubbling' => FALSE,
						// 'error_mapping'  => [],
						'help'     => 'This is is the Owner Level Account ID from your Association Management Software.',
						// 'help_attr'      => [],
						// 'help_html'      => FALSE,
						'label'    => 'Internal Owner ID',
						// 'label_attr'     => [],
						// 'label_format'   => NULL,
						'mapped'   => TRUE,
						// 'row_attr'       => [],
						'trim'     => TRUE,
					]
				)
				->add('internalPropertyId',
					TextType::class,
					[
						// 'attr'           => ['class' => ''],
						// 'data'           => '',
						'disabled' => FALSE,
						// 'required'       => FALSE,
						// 'empty_data'     => 'John Doe',
						// 'error_bubbling' => FALSE,
						// 'error_mapping'  => [],
						'help'     => 'This is is the Property Level Account ID from your Association Management Software.',
						// 'help_attr'      => [],
						// 'help_html'      => FALSE,
						'label'    => 'Internal Property ID',
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
