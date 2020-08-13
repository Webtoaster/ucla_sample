<?php
    
    namespace App\Form\ARCHIVE;

    use App\Entity\Race;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
    use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Class RaceType
     *
     * @package App\Form
     */
    class RaceType extends AbstractType
    {

        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add('association')
              ->add('election')
              ->add('raceType')
              ->add(
                'heading',
                TextType::class,
                [
                  'label'    => 'Race Heading',
                  'disabled' => false,
                  'help'     => 'First Line or Main Title of the Race:',
                  'mapped'   => true,
                  'required' => true,
                ]
              )
              ->add(
                'subheading',
                TextType::class,
                [
                  'label'    => 'Race Sub-Heading',
                  'disabled' => false,
                  'help'     => 'Second Line or Main Title of the Race: (Optional)',
                  'mapped'   => true,
                  'required' => false,
                ]
              )
              ->add('descriptionShort', PartDescriptionShortFormType::class)
              ->add('descriptionLong', PartDescriptionLongFormType::class)
              ->add('displayDescriptionLong', PartDisplayDescriptionLongFormType::class)
              ->add('sortOrder')
              ->add(
                'selectMin',
                IntegerType::class,
                [
                  'label'    => 'Enter the Minimum Number of Participants to Make Quorum',
                  'disabled' => false,
                  'help'     => '',
                  'mapped'   => true,
                  'required' => true,

                ]
              )
              ->add(
                'selectMax',
                IntegerType::class,
                [
                  'label'    => 'Enter the Maximum Number of Participants in this Election',
                  'disabled' => false,
                  'help'     => '',
                  'mapped'   => true,
                  'required' => true,

                ]
              )
              ->add(
                'allowForQuorum',
                CheckboxType::class,
                [
                  'label'    => 'Allow Owners, Members or Proxies to Vote Present to be Counted toward a Quorum Only:',
                  'disabled' => false,
                  'help'     => '',
                  'mapped'   => true,
                ]
              )
              ->add(
                'allowForAbstain',
                CheckboxType::class,
                [
                  'label'    => 'Show Option to Allow Voter to Abstain from Voting in Race:',
                  'disabled' => false,
                  'help'     => '',
                  'mapped'   => true,
                ]
              )
              ->add(
                'displayMethod',
                CheckboxType::class,
                [
                  'label'    => 'Display Method????  I am not sure.',
                  'disabled' => false,
                  'help'     => '',
                  'mapped'   => true,
                ]
              )
              ->add(
                'displayIncumbency',
                CheckboxType::class,
                [
                  'label'    => 'Show Icon when Candidate is an Incumbent:',
                  'disabled' => false,
                  'help'     => '',
                  'mapped'   => true,
                ]
              )
              ->add(
                'displayDeclared',
                CheckboxType::class,
                [
                  'label'    => 'Show Icon when Candidate is Formally Declared:',
                  'disabled' => false,
                  'help'     => '',
                  'mapped'   => true,
                ]
              )
              ->add(
                'displayWriteIn',
                CheckboxType::class,
                [
                  'label'    => 'Show Icon when Candidate is a Write In:',
                  'disabled' => false,
                  'help'     => '',
                  'mapped'   => true,
                ]
              )
              ->add('formType')
                //->add('isActive')

            ;
        }

        /**
         * @param  OptionsResolver  $resolver
         */
        /**
         * @param  OptionsResolver  $resolver
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [
                'data_class' => Race::class,
              ]
            );
        }

    }
