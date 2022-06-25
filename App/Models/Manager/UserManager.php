<?php

namespace App\Models\Manager;

use App\Exception\PropertyNotFoundException;
use App\Models\BDD;
use App\Models\Entities\User;
use PDO;

class UserManager extends BaseManager
{

    public function __construct()
    {
        parent::__construct('user', User::class);
    }
}