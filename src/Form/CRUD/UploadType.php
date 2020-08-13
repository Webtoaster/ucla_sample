<?php

    namespace App\Form\CRUD;

    use App\Entity\Upload;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class UploadType
     *
     * @package App\Form\CRUD
     */
    class UploadType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add('filePath')
              ->add('fileName')
              ->add('fileExtension')
              ->add('fileSize')
              ->add('imageWidth')
              ->add('imageHeight')
              ->add('isImage')
              ->add('uploadedBy')
              ->add('createdFromIp')
              ->add('updatedFromIp')
              ->add('createdAt')
              ->add('updatedAt')
              ->add('isActive')
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
