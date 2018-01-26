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
$routes->get('/tehtavat', function() {
    HelloWorldController::tehtavat();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});
