<?php
    
    namespace App\Validator;
    
    use Symfony\Component\Validator\Constraint;
    use Symfony\Component\Validator\ConstraintValidator;
    
    /**
     * Class MailingAddressValidator
     *
     * @package App\Validator
     */
    class MailingAddressValidator extends ConstraintValidator
    {
        
        /**
         * @param  mixed       $value
         * @param  Constraint  $constraint
         */
        public function validate($value, Constraint $constraint):void
        {
            /* @var MailingAddress $constraint */
        
            if ($value === NULL || $value === '') {
                return;
            }
        
            // TODO: implement the validation here
            $this->context->buildViolation($constraint->message)
                          ->setParameter('{{ value }}', $value)
                          ->addViolation()
            ;
        }
    
    }
