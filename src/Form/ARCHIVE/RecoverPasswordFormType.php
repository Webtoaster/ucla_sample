<?php
    
    namespace App\Form\ARCHIVE;

    use App\Form\Model\PasswordRecoveryFormModel;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class RecoverPasswordFormType
     *
     * @package App\Form
     */
    class RecoverPasswordFormType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         *
         * @return FormBuilderInterface|null
         */
        public function buildForm(FormBuilderInterface $builder, array $options):?FormBuilderInterface
        {
            $builder
              ->add(
                'email',
                PartAddressEmailFormType::class,
                [
                  'data_class' => PasswordRecoveryFormModel::class,
                ]
              );

            return $builder;
        }

        /**
         * @param  OptionsResolver  $resolver
         *
         * @return void
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
                'data_class' => PasswordRecoveryFormModel::class,
              ]
            );
        }

    }
