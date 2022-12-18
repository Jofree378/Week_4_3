<?php

use Base\Application;
// Подключение автолоадера и конфига
require '../vendor/autoload.php';

// Запуск сайта
$app = new Application();
$app->run();

