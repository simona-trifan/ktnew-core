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
 * Retrieves all insurants
 */
$app->get(
    '/api/insurants',
    function () {
        // Operation to fetch all the insurants
    }
);

/**
 * Searches for insurants with $name in their name
 */
$app->get(
    '/api/insurants/search/{name}',
    function ($name) {
        // Operation to fetch insurant with name $name
    }
);

/**
 * Retrieves insurants based on primary key
 */
$app->get(
    '/api/insurants/{id:[0-9]+}',
    function ($id) {
        // Operation to fetch insurant with id $id
    }
);

/**
 * Adds a new insurant
 */
$app->post(
    '/api/insurants',
    function () {
        // Operation to create a fresh insurant
    }
);

/**
 * Updates insurants based on primary key
 */
$app->put(
    '/api/insurants/{id:[0-9]+}',
    function ($id) {
        // Operation to update a insurant with id $id
    }
);

/**
 * Deletes insurants based on primary key
 */
$app->delete(
    '/api/insurants/{id:[0-9]+}',
    function ($id) {
        // Operation to delete the insurant with id $id
    }
);
