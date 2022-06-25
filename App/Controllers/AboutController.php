<?php

namespace App\Controllers;

use App\Concerns\ViewManager;

class AboutController extends BaseController
{
    use ViewManager;

    public function __invoke()
    {
        $this->index();
    }

    public function index()
    {
        $this->renderView('main/about');
    }
}