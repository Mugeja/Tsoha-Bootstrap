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

$routes->post('/tehtavat', function() {
    TehtavaController::store();
});

$routes->get('/tehtavat/new', function() {
    TehtavaController::create();
});
$routes->get('/tehtavat/:id', function($id) {
    TehtavaController::show($id);
});
$routes->get('/tehtava::id/edit', function($id){
    TehtavaController::edit($id);
});

$routes->post('/tehtava/:id/muokkaa', function($id){
    TehtavaController::update($id);
});

$routes->post('tehtava/:id/poista', function($id){
    TehtavaController::destroy($id);
});


