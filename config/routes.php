<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
$routes->get('/game', function() {
  HelloWorldController::game_list();
});
$routes->get('/game/1', function() {
  HelloWorldController::game_show();
});

$routes->get('/login', function() {
  HelloWorldController::login();
});