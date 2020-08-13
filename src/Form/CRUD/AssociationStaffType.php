<?php

    namespace App\Form\CRUD;

    use App\Entity\AssociationStaff;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class AssociationStaffType
     *
     * @package App\Form\CRUD
     */
    class AssociationStaffType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add('isAttorney')
              ->add('jobTitle')
              ->add('isBoardMember')
              ->add('dateStart')
              ->add('dateEnd')
              ->add('isActive')
              ->add('createdFromIp')
              ->add('updatedFromIp')
              ->add('createdAt')
              ->add('updatedAt')
              ->add('person')
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
                'data_class' => AssociationStaff::class,
              ]
            );
        }

    }
