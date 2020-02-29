<?php

require '../config/dev.php';
require '../vendor/autoload.php';

session_start();

$router = new \App\config\Router();
// check $_GET['route]
$router->run();
