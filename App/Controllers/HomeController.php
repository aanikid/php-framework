<?php

namespace App\Controllers;

use App\Concerns\ViewManager;
use App\Framework\Facade\QueryBuilderFacade;


class HomeController extends BaseController
{
    use ViewManager;

    public function __invoke()
    {
        $this->index();
    }


    public function index()
    {
        $sql = QueryBuilderFacade::select(['users.*', 'roles.name as role_name'])
            ->from('users')
            ->where('users.id', '=', 1)
            ->orderBy('users.id', 'DESC')
            ->limit(10)
            ->offset(0);
        dump($sql->toSql());
        $this->renderView('main/index');
    }
}
