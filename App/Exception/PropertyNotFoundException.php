<?php

namespace App\Exception;

use Exception;

class PropertyNotFoundException extends Exception
{
    private string $className;
    private string $property;

    public function __construct($className, $property, $message = "Property missing")
    {
        $this->className = $className;
        $this->property = $property;
        parent::__construct($message, "0001");
    }

    public function getMoreDetail(): string
    {
        return 'Property' . $this->property . "does not exist in class " . $this->className;
    }
}