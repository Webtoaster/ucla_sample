<?php
    
    namespace App\Form\ARCHIVE;

    use App\Entity\DisplayMethod;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class DisplayMethodType
     *
     * @package App\Form
     */
    class DisplayMethodType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add('descriptionShort', PartDescriptionShortFormType::class)
              ->add('descriptionLong', PartDescriptionLongFormType::class)
              ->add('displayDescriptionLong', PartDisplayDescriptionLongFormType::class)
              ->add('sortOrder')
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
                'data_class' => DisplayMethod::class,
              ]
            );
        }

    }
