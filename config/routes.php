<?php

$routes->get('/', function() {
    HelloWorldController::etusivu();
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

$routes->get('/tehtavan_muokkaus', function() {
    HelloWorldController::tehtavan_muokkaus();
});
