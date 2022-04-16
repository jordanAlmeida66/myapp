<?php
use HttpRoutes\{Route, Bootstrap};
use HttpRoutes\Exception\BootstrapException;

$route = new HttpRoutes\Route;
$route->set('get', '/name/{?name}')->callback(function($params){
  if(isset($params['name'])) {
    $name = filter_var($params['name'], FILTER_SANITIZE_STRING);
    return "seja bem vindo {$name}";
  }

  return 'seja bem vindo!';
});

$route->set('get', '/loja')->callback(function(){
  return 'loja web';
});

try {
  //iniciando a aplicação
  $init = new Bootstrap($route, 'https://myapp66.herokuapp.com/public');
} catch (BootstrapException $e) {
  //erros relacionados à rota
  http_response_code($e->getCode());
  die($e->getMessage());
}