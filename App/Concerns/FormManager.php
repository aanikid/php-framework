<?php

namespace App\Concerns;

trait FormManager
{
    public array $errors = [];
    public bool $isValidated = false;
    public bool $isSubmitted = false;

    public function formCheck(array $requestParams)
    {
        foreach ($requestParams as $param => $value) {
            if(empty($value)){
                $this->errors[$param] = $param . ' ' . 'cannot be null';
            }
        }
        if(empty($this->errors)){
            $this->isValidated = true;
           $this->isSubmitted = true;
        }
    }
}