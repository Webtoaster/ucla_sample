<?php
    
    namespace App\Form\HOLD;

    use App\Form\Model\NewAssociationModel;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class NewRegistrantCompanyType
     *
     * @package App\Form
     */
    class NewRegistrantCompanyType extends AbstractType
    {

        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
                ->add('companyName', PartNameFormalFormType::class)
                ->add('physicalAddress', PartAddressPhysicalFormType::class)
                ->add('mailingAddress', PartAddressMailingFormType::class)
                ->add('phoneWork', PartPhoneWorkFormType::class)
                ->add('phoneFax', PartPhoneFaxFormType::class)
                ->add('url', PartUrlFormType::class)
                ->add(
                'numberOfProperties',
                IntegerType::class,
                [
                  'disabled'       => false,
                  'label'          => 'How Many Properties are under Management in this Community?',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => null,
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [
                    'placeholder' => '(250)',
                  ],
                  'mapped'         => true,
                  'required'       => true,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                ]
              )
              ->add(
                'numberOfSections',
                IntegerType::class,
                [
                  'disabled'       => false,
                  'label'          => 'Are there Divided Sections in this Community?',
                  'label_attr'     => [],
                  'label_format'   => null,
                  'help'           => null,
                  'help_attr'      => [],
                  'help_html'      => false,
                  'attr'           => [
                    'placeholder' => '(3)',
                  ],
                  'empty_data'     => 1,
                  'mapped'         => true,
                  'required'       => false,
                  'trim'           => true,
                  'error_bubbling' => false,
                  'error_mapping'  => [],
                ]
              )
                ->add(
                'save_add_another',
                SubmitType::class,
                [
                  'label' => 'Save and Add Another Association',
                ]
              )
                ->add(
                'save_continue',
                SubmitType::class,
                [
                  'label' => 'Save and Continue to Next Step',
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

                // TODO See if this should be tied into another entity.
                'data_class'        => NewAssociationModel::class,
                'validation_groups' => ['new_company'],
              ]
            );
        }

    }
