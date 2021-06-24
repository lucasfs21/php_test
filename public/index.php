<?php

require '../init.php';

use Config\SiteInfo;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\App;
use App\controllers\ClientController;
$teste = new ClientController;

$app = new App;
$app->get('/', ClientController::class. ':index');
$app->get('/clients', ClientController::class. ':index');

$app->get('/clients/new', ClientController::class. ':new');
$app->post('/clients', ClientController::class. ':save');

$app->get('/clients/edit/{id}', ClientController::class. ':edit');
$app->put('/clients/{id}', ClientController::class. ':update');

$app->delete('/clients/delete/{id}', ClientController::class. ':delete');

$app->run();