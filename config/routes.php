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

$routes->get('/tehtavan_muokkaus', function() {
    HelloWorldController::tehtavan_muokkaus();
});

$routes->get('/kirjautuminen', function() {
    HelloWorldController::kirjautuminen();
});

$routes->get('/tehtavat', function() {
    TehtavaController::index();
});
