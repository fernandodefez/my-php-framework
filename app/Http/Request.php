<?php

namespace App\Http;

class Request
{
     protected $segments = [];
     protected $controller;
     protected $method;

     public function __construct()
     {
          $this->segments = explode("/", $_SERVER["REQUEST_URI"]);
          $this->setController();
          $this->setMethod();
     }

     public function setController()
     {
          $this->controller = empty($this->segments[2])
               ? 'home'
               : $this->segments[2];
     }

     public function setMethod()
     {
          $this->method = empty($this->segments[3])
               ? 'index'
               : $this->segments[3];
     }

     public function getController()
     {
          //home -> HomeController
          $controller = ucfirst($this->controller);
          return "App\Http\Controllers\\{$controller}Controller";
     }

     public function getMethod()
     {
          return $this->method;
     }

     public function send()
     {
          $controller = $this->getController();
          $method = $this->getMethod();

          // It is calling Response->send(); Method
          // $controller HomeController
          // $method index
          $response = call_user_func([
               new $controller,
               $method
          ]);

          try {
               if ($response instanceof Response) {
                    $response->send();
               } else {
                    throw new \Exception("response must be instace of Response", 1);
               }
          } catch (\Exception $e) {
               echo "Something went wrong: " . $e->getMessage();
          }
     }
}
