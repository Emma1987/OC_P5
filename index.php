<?php
require __DIR__ . '/lib/EmmaM/SplClassLoader.php';

$EmmaMLoader = new SplClassLoader('EmmaM', __DIR__ . '/lib');
$EmmaMLoader->register();

$appLoader = new SplClassLoader('App', __DIR__ . '');
$appLoader->register();

$modelLoader = new SplClassLoader('Model', __DIR__ . '/lib/vendors');
$modelLoader->register();

$entityLoader = new SplClassLoader('Entity', __DIR__ . '/lib/vendors');
$entityLoader->register();

$app = new EmmaM\Application();
$app->run();