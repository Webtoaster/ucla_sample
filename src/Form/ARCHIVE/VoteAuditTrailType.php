<?php
    
    namespace App\Form\ARCHIVE;

    use App\Entity\VoteAuditTrail;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class VoteAuditTrailType
     *
     * @package App\Form
     */
    class VoteAuditTrailType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add('voteId')
              ->add('ballotId')
              ->add('raceOptionId')
            ;
        }

        /**
         * @param  OptionsResolver  $resolver
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
                'data_class' => VoteAuditTrail::class,
              ]
            );
        }

    }
