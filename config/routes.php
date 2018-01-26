<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});
$routes->get('/etusivu', function() {
    HelloWorldController::etusivu();
});
$routes->get('/game/1', function() {
    HelloWorldController::tehtavat_show();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});
