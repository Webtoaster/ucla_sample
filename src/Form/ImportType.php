<?php
	
	namespace App\Form;
	
	use App\Entity\Import;
	use App\Entity\Person;
	use App\Form\Parts\AddressEmailFormType;
	use App\Form\Parts\AddressMailingFormType;
	use App\Form\Parts\AddressPropertyFormType;
	use App\Form\Parts\AccountNumbers;
	use App\Form\Parts\ImportCredentialsFormType;
	use App\Form\Parts\ImportLoginFormType;
	use App\Form\Parts\LegalDescriptionCountyFormType;
	use App\Form\Parts\LegalDescriptionFullFormType;
	use App\Form\Parts\LegalDescriptionLotBlockSubFormType;
	use App\Form\Parts\NameFormalFormType;
	use App\Form\Parts\NamePersonFormType;
	use App\Form\Parts\PhoneFaxFormType;
	use App\Form\Parts\PhoneHomeFormType;
	use App\Form\Parts\PhoneMobileFormType;
	use App\Form\Parts\PhoneWorkFormType;
	use App\Form\Parts\ButtonSubmitGenericSaveInformation;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\HiddenType;
	use Symfony\Component\Form\Extension\Core\Type\TextType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	
	class ImportType extends AbstractType
	{
		public function buildForm(FormBuilderInterface $builder, array $options)
		{
			$builder
				->add('associationId',
					HiddenType::class,
					[
						'trim' => TRUE,
					]
				)
				->add('companyId',
					HiddenType::class,
					[
						'trim' => TRUE,
					]
				)
				->add('accountNumber',
					AccountNumbers::class,
					[
						'data_class' => Import::class,
					]
				)
				->add('credentials',            // ->add('username') ->add('password')
					ImportCredentialsFormType::class,
					[
						'data_class' => Import::class,
					]
				)
				->add('ownershipStartDate',
					TextType::class,
					[
						// 'attr'           => ['class' => ''],
						// 'data'           => '',
						'disabled' => FALSE,
						// 'required'       => FALSE,
						// 'empty_data'     => 'John Doe',
						// 'error_bubbling' => FALSE,
						// 'error_mapping'  => [],
						'help'     => 'This is the date when an owner took possession.  This can be in any format.',
						// 'help_attr'      => [],
						// 'help_html'      => FALSE,
						'label'    => 'Ownership Start Date',
						// 'label_attr'     => [],
						// 'label_format'   => NULL,
						'mapped'   => TRUE,
						// 'row_attr'       => [],
						'trim'     => TRUE,
					]
				)
				->add(
					'nameFormal',  // ->add('nameFormal')
					NameFormalFormType::class,
					[
						'data_class' => Import::class,
					]
				)
				->add(
					'name',// ->add('nameFirst')->add('nameMiddle')->add('nameLast')->add('nameSuffix')
					NamePersonFormType::class,
					[
						'data_class' => Import::class,
					]
				)
				->add(
					'phoneHome',  // ->add('phoneHome')
					PhoneHomeFormType::class,
					[
						'data_class' => Import::class,
					]
				)
				->add(
					'phoneMobile',  // ->add('phoneMobile')
					PhoneMobileFormType::class,
					[
						'data_class' => Import::class,
					]
				)
				->add(
					'phoneWork',  // ->add('phoneWork')
					PhoneWorkFormType::class,
					[
						'data_class' => Import::class,
					]
				)
				->add(
					'phoneFax',         // ->add('phoneFax')
					PhoneFaxFormType::class,
					[
						'data_class' => Import::class,
					]
				)
				->add(                      // ->add('email')
					'email',
					AddressEmailFormType::class,
					[
						'data_class' => Person::class,
					]
				)
				->add(                // ->add('propertyAddressLine1')->add('propertyAddressLine2')->add('propertyAddressCity')->add('propertyAddressState')->add('propertyAddressZipCode')
					'propertyAddress',
					
					AddressPropertyFormType::class,
					[
						'data_class' => Import::class,
					]
				)
				->add(                // ->add('mailingAddressLine1')->add('mailingAddressLine2')->add('mailingAddressCity')->add('mailingAddressState')->add('mailingAddressZipCode')->add('mailingAddressCountry')
					'mailingAddress',
					
					AddressMailingFormType::class,
					[
						'data_class' => Import::class,
					]
				)
				->add('county',
					LegalDescriptionCountyFormType::class,
					[
						'data_class' => Import::class,
					]
				)
				->add('lotBlockSubdivision',
					LegalDescriptionLotBlockSubFormType::class,
					[
						'data_class' => Import::class,
					]
				)
				->add('legalDescription',
					LegalDescriptionFullFormType::class,
					[
						'data_class' => Import::class,
					]
				)
				->add('upload', HiddenType::class)
				->add('importStatus', HiddenType::class)
				->add('save',
					ButtonSubmitGenericSaveInformation::class,
					[
						'mapped' => FALSE,
					]
				)
				// ->add('createdAt', HiddenType::class)
			;
		}
		
		public function configureOptions(OptionsResolver $resolver)
		{
			$resolver->setDefaults([
					'data_class' => Import::class,
				]
			);
		}
	}
