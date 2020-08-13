<?php
    
    namespace App\Form\ARCHIVE;

    use App\Entity\Sessions;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class SessionsType
     *
     * @package App\Form
     */
    class SessionsType extends AbstractType
    {

        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add('sessData')
              ->add('sessTime')
              ->add('sessLifetime')
            ;
        }


        /**
         * @param  OptionsResolver  $resolver
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
                'data_class' => Sessions::class,
              ]
            );
        }

    }
