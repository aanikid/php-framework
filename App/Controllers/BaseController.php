<?php

namespace App\Controllers;


abstract class BaseController
{
    public function renderView(string $filePath, array $data = [], string $template = 'home.layout')
    {

        extract($data);

        ob_start();

        $content = ROOT . '/App/Views/' . $filePath . '.php';

        ob_end_clean();

        require_once ROOT . '/App/Views/' . $template . '.php';
    }
}
