<?php

    namespace App\Form\CRUD;

    use App\Entity\Property;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class PropertyType
     *
     * @package App\Form\CRUD
     */
    class PropertyType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add('extHoaPropertyId')
              ->add('extCadPropertyId')
              ->add('dateStart')
              ->add('dateEnd')
              ->add('physicalAddressLine1')
              ->add('physicalAddressLine2')
              ->add('physicalAddressCity')
              ->add('physicalAddressState')
              ->add('physicalAddressZipCode')
              ->add('legalLot')
              ->add('legalSection')
              ->add('legalBlock')
              ->add('legalDescription')
              ->add('createdFromIp')
              ->add('updatedFromIp')
              ->add('createdAt')
              ->add('updatedAt')
              ->add('isActive')
              ->add('owner')
              ->add('association')
            ;
        }


        /**
         * @param  OptionsResolver  $resolver
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
                'data_class' => Property::class,
              ]
            );
        }

    }
