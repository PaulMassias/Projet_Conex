<?php

 namespace App\Classe;

 class Service {

   private $parameters;

   public function __construct(){

      $stringedParam = file_get_contents('../var/parametres/param.txt');
      $this->parameters = $stringedParam;

   }

   public function getParam(){
      return $this->parameters;
   }

 }




