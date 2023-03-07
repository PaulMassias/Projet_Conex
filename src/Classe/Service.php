<?php

 namespace App\Classe;

 class Service {

   private $parameters;


   public function __construct(){

      // On récupère le contenu du fichier "param.txt" que l'on met dans la variable "stringedParam"
      $stringedParam = file_get_contents('../src/config.txt');
      //On stocke ensuite le contenu décodé dans le membre "parameters" de la classe
      $this->parameters = json_decode($stringedParam);

   }


   //Cette fonction permet d'effectuer le calcul d'émission commun à tous les calculs
   private function calculCommun($taillefichier, $tempsvisio){
      $emissions = $this->parameters->ConsoActeTele; // On compte la consommation de fonctionnement de l'application
      $emissions += $this->parameters->ConsoEnvArchFich*$taillefichier; // Ainsi que la consommation d'archivage et d'échange de fichiers
      $emissions += $this->parameters->ConsoVisio*$tempsvisio; // Pour finir on prends la consommation d'une visio en fonction de son temps
      return $emissions; // On retourne ensuite la valeur d'émissions pour pouvoir poursuivre le calcul
   }


   public function calculGainTCAParam($taillefichier, $tempsvisio){
      $emissions= $this->calculCommun($taillefichier, $tempsvisio); // On appelle la fonction de calcul de la partie commune
      $emissions += $this->parameters->ConsoDepHAD; // Auxquelles on ajoute les consommations particulières de méthodes si il y en a
      $gains = $this->parameters->GainPatiMed; // On définit ensuite les gains
      $resultat = $gains - $emissions; // Pour finir on déduit les émissions des gains
      return $resultat;
   }


   public function calculGainTCParam($taillefichier, $tempsvisio){
      $emissions= $this->calculCommun($taillefichier, $tempsvisio);// On appelle la fonction de calcul de la partie commune
      $gains = $this->parameters->GainPatiMed;// On définit ensuite les gains
      $resultat = $gains - $emissions;// Pour finir on déduit les émissions des gains
      return $resultat;
   }

   
   public function calculGainTEParam($taillefichier, $tempsvisio){
      $emissions= $this->calculCommun($taillefichier, $tempsvisio);// On appelle la fonction de calcul de la partie commune
      $gains = $this->parameters->GainPatiSpe;// On définit ensuite les gains
      $gains += $this->parameters->GainPatiUrg;
      $resultat = $gains - $emissions;// Pour finir on déduit les émissions des gains
      return $resultat;
   }


 }




