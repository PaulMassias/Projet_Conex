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

   public function calculGainTCA(){
      $param = json_decode($this->parameters);
      $emissions = $param->ConsoActeTele;
      $emissions += $param->ConsoEnvArchFich*2; //Taille des fichiers échangés par défaut = 2Mo
      $emissions += $param->ConsoVisio*10; // Duree de la visio par défaut 10 min
      $emissions += $param->ConsoDepHAD;
      $gains = $param->GainPatiMed;
      $resultat = $gains - $emissions;
      return $resultat;
   }

 }




