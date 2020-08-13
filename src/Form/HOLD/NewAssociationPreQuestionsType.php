<?php
    
    namespace App\Form\HOLD;

    use App\Entity\PersonType;
    use App\Entity\Person;
    use App\Form\Model\PersonTypeFormModel;
    use App\Repository\PersonTypeRepository;
    use Doctrine\DBAL\DBALException;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\NotNull;

    /**
     * Class NewAssociationPreQuestionsType
     *
     * @package App\Form
     */
    class NewAssociationPreQuestionsType extends AbstractType
    {


        private $personTypeRepository;

        private $choices;

        /**
         * NewAssociationPreQuestionsType constructor.
         *
         * @param  PersonTypeRepository  $personTypeRepository
         *
         * @throws DBALException
         */
        public function __construct(PersonTypeRepository $personTypeRepository)
        {
            $this->personTypeRepository = $personTypeRepository;
            $this->choices              = $this->personTypeRepository->queryForPersonTypeForm();
        }

        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
              ->add(
                'personType',
                EntityType::class,
                [
                  'class'           => PersonType::class,
                  'choice_label'    => 'descriptionLong',
                  'expanded'        => true,
                  'multiple'        => false,
                  'label'           => 'Which statement best describes you?',
                  'required'        => true,
                  'invalid_message' => 'Select one of the Choices Below.',
                  'constraints'     => [
                    new NotNull(
                      [
                        'message' => 'Select one of the Choices Below.',
                      ]
                    ),
                  ],

                  //	'choice_label' => 'personTypeValue',
                  //	'mapped'=> FALSE,
                  //	'choice_value'    => 'personTypeId',
                  //	'placeholder'     => 'Select One.',
                  //	'choices'         => $this->personTypeRepository->queryForPersonTypeForm(),

                ]
              );
        }



        /**
         * @param  OptionsResolver  $resolver
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
              [

                //'data_class' => null,

                 'data_class' => Person::class,
                // 'data_class' => PersonTypeFormModel::class,
              ]
            );
        }

    }



    // $builder
    // 	->add('personTypeId', ChoiceType::class, [
    // 			'label'        => 'Which statement best describes you?',
    // 			'choices'      => $this->choices,
    // 			//	'class'           => PersonType::class,
    // 			'choice_value' => 'person_type_id',
    // 			'choice_label' => 'person_type_value',
    // 			//	'placeholder'     => 'Select One.',
    // 			'expanded'     => TRUE,
    // 			'multiple'     => FALSE,
    // 			//	'choices'      => $this->personTypeRepository->queryForPersonTypeForm(),
    // 			'required'     => TRUE,
    // 			//	'invalid_message' => 'Quit Screwing Around!  This Option is not Valid.',
    // 			//	'mapped'=>false,
    //
    // 			'constraints' => [
    // 				new NotNull([
    // 					'message' => 'Select an Option from Below.',
    // 				]),
    // 			],
    // 		]
    // 	);
