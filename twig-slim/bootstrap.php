<?php

require "vendor/autoload.php";

use Slim\App;

$config['displayErrorDetails'] = true; //Mostra os erros

$app = new App(['settings' => $config]);