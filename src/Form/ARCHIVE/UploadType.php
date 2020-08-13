<?php
    
    namespace App\Form\ARCHIVE;

    use App\Entity\Upload;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\Length;
    use Symfony\Component\Validator\Constraints\NotBlank;

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
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add(
                'uploadId',
                IntegerType::class,
                [
                  'disabled'       => true,
                  'label'          => 'Primary Key to Uploads',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => true,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                ]
              )
              ->add(
                'uploadedBy',
                TextType::class,
                [
                  'disabled'       => true,
                  'label'          => 'Foreign Key to Person',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => true,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                  'constraints'    => [
                    new NotBlank(['message' => 'Please enter a Foreign Key to Person ',]),
                  ],
                ]
              )
              ->add(
                'filePath',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'File Path',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => true,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                  'constraints'    => [
                    new Length(
                      [
                        'min'        => 1,
                        'minMessage' => 'File Path must be at least {{ limit }} characters in length.',
                        'max'        => 128,
                        'maxMessage' => 'File Path cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'fileName',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'File Name',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => true,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                  'constraints'    => [
                    new Length(
                      [
                        'min'        => 1,
                        'minMessage' => 'File Name must be at least {{ limit }} characters in length.',
                        'max'        => 64,
                        'maxMessage' => 'File Name cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'fileExtension',
                TextType::class,
                [
                  'disabled'       => false,
                  'label'          => 'File Extension',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => true,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                  'constraints'    => [
                    new Length(
                      [
                        'min'        => 1,
                        'minMessage' => 'File Extension must be at least {{ limit }} characters in length.',
                        'max'        => 4,
                        'maxMessage' => 'File Extension cannot exceed {{ limit }} characters.',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'fileSize',
                IntegerType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Size of The File (In Bytes)',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => false,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                ]
              )
              ->add(
                'isImage',
                ChoiceType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Is File An Image',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => true,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                  'constraints'    => [
                    new NotBlank(
                      [
                        'message' => 'Please enter a Is File An Image ',
                      ]
                    ),
                  ],
                ]
              )
              ->add(
                'imageWidth',
                IntegerType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Image Width',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => false,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                ]
              )
              ->add(
                'imageHeight',
                IntegerType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Image Height',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => '',
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [],
                  'mapped'         => true,
                  'required'       => false,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                ]
              )
            ;
        }


        /**
         * @param  OptionsResolver  $resolver
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
	              'data_class' => Upload::class,
              ]
            );
        }

    }
    //            ->add('filePath')
    //            ->add('fileName')
    //            ->add('fileExtension')
    //            ->add('fileSize')
    //            ->add('imageWidth')
    //            ->add('imageHeight')
    //            ->add('isImage')
    //            ->add('uploadedBy')
    //            ->add('updatedAt')
    //            ->add('createdAt')
    //            ->add('isActive')
