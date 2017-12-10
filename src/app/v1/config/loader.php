<?php

/**
 * Registering an autoloader
 */
$loader = new \Phalcon\Loader();

$loader->registerDirs(
    [
        $config->application->modelsDir
    ]
);

$loader->registerNamespaces(
    [
        'Insurant\Models' => APP_PATH . '/models/',
        'Insurant\Controllers' => APP_PATH . '/controllers/',
        'Insurant\Services' => APP_PATH . '/services/',
        'Insurant\Exceptions' => APP_PATH . '/exceptions/',
    ]
);

$loader->register();
