<?php
use Phalcon\Mvc\Micro\Collection as MicroCollection;

/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

/**
 * Add your routes here
 */
$app->get('/', function () use ($app) {
    $response = $app->response;
    $response->setStatusCode(401, "Unauthorized");
    $response->setContent("Access is not authorized");

    return $response;
});

/**
 * Not found handler
 */
$app->notFound(function () use($app) {
    $response = $app->response;
    $response->setStatusCode(404, "Not Found");
    $response->setContent("Page not foundsss");

    return $response;
});

/**
 * Insurants handler
 */
$insurant = new MicroCollection();
$insurant->setHandler('Insurant\Controllers\InsurantController', true);
$insurant->setPrefix('/insurant');
$insurant->get('/get/{id}', 'get');
$insurant->post('/add', 'add');
$insurant->put('/update/{id}', 'update');
$insurant->delete('/delete/{id}', 'delete');
$app->mount($insurant);
