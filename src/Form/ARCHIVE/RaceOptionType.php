<?php
    
    namespace App\Form\ARCHIVE;

    use App\Entity\RaceOption;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;

    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class RaceOptionType
     *
     * @package App\Form
     */
    class RaceOptionType extends AbstractType
    {


        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add(
                'race',
                TextType::class,
                [
                  'label'    => 'Race Name/Description',
                  'disabled' => true,
                ]
              )
              ->add(
                'nameDisplay',
                PartNameDisplayFormType::class,
                [
                  'data_class' => RaceOption::class,
                ]
              )
              ->add(
                'name',
                PartNamePersonFormType::class,
                [
                  'data_class' => RaceOption::class,
                ]
              )
              ->add(
                'email',
                PartAddressEmailFormType::class,
                [
                  'data_class' => RaceOption::class,
                ]
              )
              ->add(
                'phoneHome',
                PartPhoneHomeFormType::class,
                [
                  'data_class' => RaceOption::class,
                ]
              )
              ->add(
                'phoneWork',
                PartPhoneWorkFormType::class,
                [
                  'data_class' => RaceOption::class,
                ]
              )
              ->add(
                'phoneMobile',
                PartPhoneMobileFormType::class,
                [
                  'data_class' => RaceOption::class,
                ]
              )
              //->add('phoneFax')
              ->add(
                'physicalAddress',
                PartAddressPhysicalFormType::class,
                [
                  'data_class' => RaceOption::class,
                ]
              )
              ->add(
                'mailingAddress',
                PartAddressMailingFormType::class,
                [
                  'data_class' => RaceOption::class,
                ]
              )
              ->add('displayCandidateAddress')

              ->add('isWriteIn')
              ->add('writeInByOwner')
              ->add('shareWriteIn')

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
                'data_class' => RaceOption::class,
              ]
            );
        }

    }
