<?php
use Phalcon\Mvc\Micro\Collection as MicroCollection;

/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

/**
 * Add your routes here
 */
$app->get('/', function () {
    echo $this['view']->render('index');
});

/**
 * Not found handler
 */
$app->notFound(function () use($app) {
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo $app['view']->render('404');
});

/**
 * Insurants handler
 */
$insurant = new MicroCollection();
$insurant->setHandler('InsurantController', true);
$insurant->setPrefix('/insurant');
$insurant->get('/get/{id}', 'get');
$insurant->post('/add/{payload}', 'add');
$insurant->put('/update/{id}', 'update');
$insurant->delete('/delete/{id}', 'delete');
$app->mount($insurants);
