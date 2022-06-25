<?php

namespace App\Models\Entities;

use App\Models\Manager\BaseManager;
use App\Models\Manager\UserManager;
use Exception;

class User extends BaseManager
{
    public $id;
    public $mail;
    public $password;
    public $user = [];

    public function __construct()
    {
        parent::__construct('user', self::class);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    public function __get(string $name)
    {
        return $this->user[$name];
    }

    public function __set($name, $value) {
        $this->user[$name] = $value;
    }



}