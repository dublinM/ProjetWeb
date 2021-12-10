<?php

require_once('./core/App.php' );
require './core/config/config.php';
$app = new App();



$app->autoload();
$app->config();
$app->start();

