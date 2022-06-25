<?php

namespace App\Concerns;

trait ViewManager
{
    public string $viewPath = ROOT . '/App/Views/';

    public function renderView(string $filePath, array $data = [], $layout = 'home.layout')
    {
        extract($data);
        ob_start();
        ob_end_clean();
        require_once($this->viewPath . $filePath . '.php');
    }

    public function redirect(string $url, ?string $param = null, ?string $value = null): void
    {
        if(null !== $param && null !== $value){
            header('Location: ' . $url . '?'. $param .'=' . $value);
        }else{
            header('Location: ' . $url);
        }
    }

    public function generateCss(string $path): string
    {
        return '<link rel="stylesheet" type="text/css" href="' . $this->formatAssetsPath($path, 'css')  . '" />';
    }

    public function generateJs(string $path): string
    {
        return '<link rel="stylesheet" type="text/css" href="' . $this->formatAssetsPath($path, 'js')  . '" />';
    }

    private function formatAssetsPath($filePath, $assetType): string
    {
        $arr = explode('/', $filePath);

        return $this->viewPath . array_shift($arr) . '/'. $assetType  .'/' . array_pop($arr) .'.' .$assetType;
    }
}
