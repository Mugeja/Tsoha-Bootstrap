<?php

$routes->get('/', function() {
UserController::login();
});

$routes->get('/hiekkalaatikko', function() {
HelloWorldController::sandbox();
});

$routes->get('/etusivu', function() {
UserController::login();
});

$routes->get('/tehtavan_muokkaus', function() {
HelloWorldController::tehtavan_muokkaus();
});
$routes->get('/tehtavat', function() {
TehtavaController::index();
});

$routes->post('/tehtavat', function() {
TehtavaController::store();
});
$routes->post('/rekisteroidy', function() {
UserController::store();
});
$routes->get('/tehtavat/new', function() {
TehtavaController::create();
});
$routes->get('/tehtavat/:id', function($id) {
TehtavaController::show($id);
});
$routes->get('/tehtavat/:id/muokkaa', function($id) {
TehtavaController::edit($id);
});

$routes->post('/tehtavat/:id/muokkaa', function($id) {
TehtavaController::update($id);
});
$routes->post('/tehtavat/:id/poista', function($id) {
TehtavaController::destroy($id);
});
$routes->get('/kirjaudu', function() {
UserController::login();
});
$routes->post('/kirjaudu', function() {
UserController::handle_login();
});
$routes->post('/kirjaudu_ulos', function() {
UserController::logout();
});
$routes->get('/kayttajat', function(){
UserController::kayttajat();
});


