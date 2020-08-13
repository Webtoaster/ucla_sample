<?php
	
	namespace App\Form;
	
	use App\Entity\Upload;
	use App\Form\Parts\ButtonUploadFile;
	use Symfony\Component\Form\AbstractType;
	use Symfony\Component\Form\Extension\Core\Type\FileType;
	use Symfony\Component\Form\FormBuilderInterface;
	use Symfony\Component\OptionsResolver\OptionsResolver;
	use Symfony\Component\Validator\Constraints\File;
	
	/**
	 * Class UploadType
	 *
	 * @package App\Form
	 */
	class UploadType extends AbstractType
	{
		
		/**
		 * {@inheritdoc}
		 */
		public function buildForm(FormBuilderInterface $builder, array $options)
		{
			
			$fileConstraints = new File([
					'maxSize'          => $_ENV['DATA_UPLOAD_MAX_SIZE'],
					'maxSizeMessage'   => 'The file you have uploaded is too big.',
					'mimeTypes'        => [
						'application/vnd.ms-excel',
						'text/csv',
						'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
					],
					'mimeTypesMessage' => 'You can only upload Excel and CSV files.',
				]
			);
			
			$builder
				->add(
					'dataFile',
					FileType::class,
					[
						'label'       => 'Upload Spreadsheet File.',
						'mapped'      => FALSE,
						'required'    => FALSE,
						'constraints' => $fileConstraints,
					]
				)
				->add('newFileName')
				->add('originalUploadedFileName')
				->add('mimeType')
				->add('guessedFileExtension')
				->add('absoluteFilePath')
				->add('webPath')
				->add('createdFromIp')
				->add('updatedFromIp')
				->add('createdAt')
				->add('updatedAt')
				->add('isActive')
				// ->add(
				//     'Submit',
				//     ButtonType::class,
				//     [
				//         'label' => 'Upload File',
				//         'attr' =>   ['class'=>'btn'],
				//     ]
				// )
				
				->add('save',
					ButtonUploadFile::class
				)
			;
		}
		
		/**
		 * {@inheritdoc}
		 */
		public function configureOptions(OptionsResolver $resolver)
		{
			$resolver->setDefaults(
				[
					'data_class' => Upload::class,
				]
			);
		}
		
	}
