<?php

    namespace App\Form\CRUD;

    use App\Entity\Ballot;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class BallotType
     *
     * @package App\Form\CRUD
     */
    class BallotType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add('ballotKey')
              ->add('ipAddress')
              ->add('urlOnlineBallot')
              ->add('urlPaperBallot')
              ->add('uriPaperTrace')
              ->add('dateCast')
              ->add('priorBallotId')
              ->add('createdFromIp')
              ->add('updatedFromIp')
              ->add('createdAt')
              ->add('updatedAt')
              ->add('isActive')
              ->add('ballotType')
              ->add('voter')
            ;
        }


        /**
         * @param  OptionsResolver  $resolver
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
                'data_class' => Ballot::class,
              ]
            );
        }

    }
