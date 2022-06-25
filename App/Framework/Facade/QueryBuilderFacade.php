<?php

namespace App\Framework\Facade;

use App\Framework\QueryBuilder;

class QueryBuilderFacade
{
    public static function __callStatic($name, $arguments)
    {
        $queryBuilder = new QueryBuilder();
        return call_user_func_array([$queryBuilder, $name], $arguments);
    }
}