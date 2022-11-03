<?php

class Validator
{
    private $_errors = [];
    private $_accepted_rules = [
        'required', 
        'min_len', 
        'max_len', 
        'alpha_numeric', 
        'numeric', 
        'alpha', 
        'first_letter_upper_case',
        'contains_special_symbol',
        'email',
        'phone_number',
        'date',
        'same_as',
    ];

    public function getAcceptedRules()
    {
        return $this->_accepted_rules;
    }

    public function validate($data, $rules = []){
        foreach ($data as $item_name => $item_value) {
            if(key_exists($item_name,$rules)){
                foreach ($rules[$item_name] as $rule_name => $rule_value) {
                    if (is_int($rule_name))
                        $rule_name = $rule_value;

                    switch ($rule_name) {
                        case 'required':
                            if (empty($item_value) && $rule_value)
                                $this->addError($item_name, ucwords($item_name) . 'is required');
                            break;

                        case 'min_len':
                            if (strlen($item_value) < $rule_value)
                                $this->addError($item_name, ucwords($item_name) . ' should be minimum ' . $rule_value . ' characters');
                            break;

                        case 'max_len':
                            if (strlen($item_value) > $rule_value)
                                $this->addError($item_name, ucwords($item_name) . ' should be maximum ' . $rule_value . ' characters');
                            break;

                        case 'alpha_numeric':
                            if (!ctype_alnum($item_value) && $rule_value)
                                $this->addError($item_name, ucwords($item_name) . ' should be alpha numeric');
                            break;
                        case 'numeric':
                            if (!ctype_digit($item_value) && $rule_value)
                                $this->addError($item_name, ucwords($item_name) . ' should be numeric');
                            break;
                        case 'alpha':
                            if (!ctype_alpha($item_value) && $rule_value)
                                $this->addError($item_name, ucwords($item_name) . ' should be alphabetic characters');
                            break;
                        case 'first_letter_upper_case':
                            if (!ctype_upper($item_value[0]) && $rule_value)
                                $this->addError($item_name, ucwords($item_name) . ' should have the first letter upper case');
                            break;
                        case 'contains_special_symbol':
                            $pattern = "!%&()=\[\]#@,.;+]+\.[";
                            $regex = '/^(' . $pattern . ')$/u';
                            if (!preg_match($regex, $item_value))
                                $this->addError($item_name, ucwords($item_name) . ' should have at least one special character');
                            break;
                        case 'email':
                            if (!filter_var($item_value, FILTER_VALIDATE_EMAIL))
                                $this->addError($item_name, $item_name . ' should be an email');
                            break;
                        case 'phone_number':
                            if (!preg_match('/^[0-9]{10}$/', $item_value))
                                $this->addError($item_name, $item_name . ' should be a valid phone number');
                            break;
                        case 'date':
                            if (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $item_value))
                                $this->addError($item_name, $item_name . ' should be a valid date');
                            break;
                        case 'same_as':
                            if ($item_value != $data[$rule_value])
                                $this->addError($item_name, $item_name . ' should be same as ' . $rule_value);
                            break;
                        default:
                            $this->addError($item_name,'No validation found for '.$item_name);
                    }

                }
            }
        }   
    }

    private function addError($item, $error)
    {
        $this->_errors[$item][] = $error;
    }

    public function hasErrors()
    {
        return !empty($this->_errors);
    }

    public function getErrors()
    {
        return $this->_errors;
    }
}