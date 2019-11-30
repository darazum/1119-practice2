<?php
require '../init.php';

$app = new Application();
try {
    $app->run();
} catch (RouterException $exception) {
    echo 'Page not found: ' . $exception->getMessage();
    die;
} catch (Exception $exception) {
    include '../pages/error.php';
}