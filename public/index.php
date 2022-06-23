<?php

use Symfony\Component\Dotenv\Dotenv;

define('ROOT', dirname(__DIR__));
require_once(ROOT. '/vendor/autoload.php');
$dotenv = new Dotenv();
$dotenv->loadEnv(ROOT.'/.env');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php require_once(ROOT . '/App/Routes/web.php') ?>
</body>
</html>