<?php
    
    namespace App\Form;
    
    use App\Entity\Election;
    use App\Form\Parts\AddressMailingFormType;
    use App\Form\Parts\AddressPhysicalFormType;
    use App\Form\Parts\HeadingFormType;
    use App\Form\Parts\HeadingSubFormType;
    use App\Form\Parts\ButtonSubmitGenericSaveInformation;
    use FOS\CKEditorBundle\Form\Type\CKEditorType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
    use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
    use Symfony\Component\Form\Extension\Core\Type\HiddenType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    
    /**
     * Class ElectionFormType
     *
     * @package App\Form
     */
    class ElectionFormType extends AbstractType
    {
        
        /**
         * @param  FormBuilderInterface  $builder
         * @param  array                 $options
         */
        public function buildForm(FormBuilderInterface $builder, array $options):void
        {
            $builder
	            ->add(
                    'heading',
                    HeadingFormType::class,
                    [
                        'data_class' => Election::class,
                    ]
                )
	            ->add(
                    'subheading',
                    HeadingSubFormType::class,
                    [
                        'data_class' => Election::class,
                    ]
                )
	            ->add(
		            'information',
		            CKEditorType::class,
		            [
			            'label'       => 'Information about the Election.  ',
			            'help'        => '<i>This information appears at the Top all Ballots and Below the SubHeading.</i>',
			            'help_html'   => TRUE,
			            'config_name' => 'election',
			
			            // 'config'     => [
			            //     'uiColor'  => '#ffffff',
			            //     'toolbar'  => 'full',
			            //     'required' => TRUE,
			            // ],
			            'data_class'  => Election::class,
		            ]
	            )
	            ->add(
		            'dateStart',
		            DateTimeType::class,
		            [
			            'label'          => 'Election Starts On:',
			            'years'          => $this->getYears(),
			            'date_widget'    => 'choice',
			            'model_timezone' => 'America/Chicago',
			            'view_timezone'  => 'America/Chicago',
		
		            ]
	            )
	            ->add(
		            'dateEnd',
		            DateTimeType::class,
		            [
			            'label'          => 'Election Ends On:',
			            'years'          => $this->getYears(),
			            'date_widget'    => 'choice',
			            'model_timezone' => 'America/Chicago',
			            'view_timezone'  => 'America/Chicago',
			            'help'           => 'If the Election End Date Occurs at a Meeting of the Association, DO NOT forget to include this in the Election Information field.',
		            ]
	            )
	            ->add(
                    'physicalAddress',
                    AddressPhysicalFormType::class,
                    [
                        'data_class' => Election::class,
                    ]
                )
	            ->add(
                    'mailingAddress',
                    AddressMailingFormType::class,
                    [
                        'data_class' => Election::class,
                    ]
                )
	            ->add('displayPhysicalAddress')
	            ->add('displayMailingAddress')
	            ->add('electionState', HiddenType::class)
	            ->add('votesMax',
		            IntegerType::class,
		            [
			            'label' => 'Maximum Votes that can be Cast:',
			            'help'  => 'Legal Note:  This cannot be changed.  This comes from the either the number of Owner/Members in your Association or the number of Owners Imported.',
		            ]
	            )
	            ->add('votesMin',
		            IntegerType::class,
		            [
			            'label' => 'Minimum Number of Votes Required to Satisfy Quorum:',
			            'help'  => 'Legal Note:  In the Bylaws of many Associations, a minimum number of Owner/Members must participate in an Election to satisfy Quorum Requirements for an Election to be Legal.',
		            ]
	            )
	            ->add('voterMinPercent',
		            IntegerType::class,
		            [
			            'label' => 'Do you want to allow Proxy Voting to take Place.',
			            'help'  => 'Legal Note:  In the Bylaws of many Associations, a minimum percentage of Owner/Members must participate in an Election to satisfy Quorum Requirements for an Election to be Legal.',
		            ]
	            )
	            ->add(
		            'allowProxyVoting',
		            CheckboxType::class,
		            [
			            'label' => 'Do you want to allow Proxy Voting to take Place.',
			            'help'  => 'Legal Note:  In some states, allowing Voters to Vote by Proxy is required.',
		            ]
	
	            )
	            ->add('allowInPersonVoting',
		            CheckboxType::class,
		            [
			            'label' => 'Can you Vote In-Person at the Physical Location.',
		            ]
	            )
	            ->add('allowWriteInCandidates',
		            CheckboxType::class,
		            [
			            'label' => 'Are Write-In Candidates Allowed?',
		            ]
	            )
	            ->add('allowProxyDirected',
		            CheckboxType::class,
		            [
			            'label' => 'Will this Election allow the use of Directed Proxies?',
		            ]
	            )
	            ->add('allowProxyNondirected',
		            CheckboxType::class,
		            [
			            'label' => 'Will this Election allow the use of Non-Directed Proxies?',
		            ]
	            )
	            ->add('allowProxyRevocation',
		            CheckboxType::class,
		            [
			            'label' => 'Can a Voter Revoke a Proxy once it has been Assigned?',
		            ]
	            )
	            ->add('allowMailInBallots',
		            CheckboxType::class,
		            [
			            'label' => 'Can Voters Mail In their Ballots or Proxies?',
		            ]
	            )
	            ->add('allowPublicResults',
		            CheckboxType::class,
		            [
			            'label' => 'Can the Results of the Election be posted here Publicly?',
		            ]
	            )
	            ->add('save',
		            ButtonSubmitGenericSaveInformation::class,
		            [
			            'mapped' => FALSE,
		            ]
	            )
	            
	            
                
                
                // ->add('urlElection')
                // ->add('urlRules')
            
            ;
        }
        
        /**
         * @param  OptionsResolver  $resolver
         */
        public function configureOptions(OptionsResolver $resolver):void
        {
            $resolver->setDefaults(
                [
                    'data_class' => Election::class,
                ]
            );
        }
	
	
	    /**
	     * @return array
	     */
	    private function getYears():array
	    {
		    $current_year = date('Y');
		
		    return range($current_year, $current_year + 1);
	    }
        
        
    }
