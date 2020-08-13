<?php

    namespace App\Form\CRUD;

    use App\Entity\Voter;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class VoterType
     *
     * @package App\Form\CRUD
     */
    class VoterType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add('isProxy')
              ->add('updatedByPersonId')
              ->add('createdByPersonId')
              ->add('memorandum')
              ->add('createdFromIp')
              ->add('updatedFromIp')
              ->add('createdAt')
              ->add('updatedAt')
              ->add('isActive')
              ->add('property')
              ->add('election')
              ->add('proxyPerson')
            ;
        }


        /**
         * @param  OptionsResolver  $resolver
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
                'data_class' => Voter::class,
              ]
            );
        }

    }
