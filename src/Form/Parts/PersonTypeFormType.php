<?php
    
    namespace App\Form\Parts;
    
    use App\Entity\PersonType;
    use App\Repository\PersonTypeRepository;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\NotNull;
    
    /**
     * Class PersonTypeFormType
     *
     * @package App\Form
     */
    class PersonTypeFormType extends AbstractType
    {
        
        private $personTypeRepository;
        
        
        /**
         * PersonTypeFormType constructor.
         *
         * @param  PersonTypeRepository  $personTypeRepository
         */
        public function __construct(PersonTypeRepository $personTypeRepository)
        {
            $this->personTypeRepository = $personTypeRepository;
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
                        'expanded'        => TRUE,
                        'multiple'        => FALSE,
                        'label'           => 'Which statement best describes you?',
                        'required'        => TRUE,
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
                    'inherit_data' => TRUE,
                ]
            );
        }
        
    }
