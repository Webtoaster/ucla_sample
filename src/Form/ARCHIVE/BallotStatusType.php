<?php
    
    namespace App\Form\ARCHIVE;

    use App\Entity\BallotStatus;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class BallotStatusType
     *
     * @package App\Form
     */
    class BallotStatusType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add('descriptionShort')
              ->add('descriptionLong')
              ->add('displayDescriptionLong')
              ->add('sortOrder')
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
                'data_class' => BallotStatus::class,
              ]
            );
        }

    }
