<?php

namespace App\Controller;

use App\Entity\Result;
use App\Classe\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;



class MainAPIController extends AbstractController
{
    #[Route('/tc', name: 'app_tc_API')]
    public function resultatTC(){

        $service = new Service(); // On crée la classe service qui nous permettra d'appeler les méthodes de calcul
        $gain = $service->calculGainTC(); // On appelle la méthode de calcul correspondante a la route

        $resultat = new Result();
        $resultat
            ->setTitle('Gain Teleconsultation')
            ->setResultat($gain)
        ;
        $normalizers = [
            new ObjectNormalizer(),
        ];

        $encoders =[
            new JsonEncoder(),
        ];

        $serializer = new Serializer($normalizers,$encoders);
        $SerData = $serializer->serialize($resultat, 'json');

        $response = new Response($SerData);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    #[Route('/tc/{fichier}/{visio}', name: 'app_tc_param_API')]
    public function resultatTCParam(int $fichier, int $visio){

        $service = new Service(); // On crée la classe service qui nous permettra d'appeler les méthodes de calcul
        $gain = $service->calculGainTCParam($fichier, $visio); // On appelle la méthode de calcul correspondante a la route

        $resultat = new Result();
        $resultat
            ->setTitle('Gain Teleconsultation')
            ->setResultat($gain)
        ;
        $normalizers = [
            new ObjectNormalizer(),
        ];

        $encoders =[
            new JsonEncoder(),
        ];

        $serializer = new Serializer($normalizers,$encoders);
        $SerData = $serializer->serialize($resultat, 'json');

        $response = new Response($SerData);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    #[Route('/tca', name: 'app_tca_API')]
    public function resultatTCA(){

        $service = new Service(); // On crée la classe service qui nous permettra d'appeler les méthodes de calcul
        $gain = $service->calculGainTCA(); // On appelle la méthode de calcul correspondante a la route

        $resultat = new Result();
        $resultat
            ->setTitle('Gain Teleconsultation assistee')
            ->setResultat($gain) // On stocke le résultat de la méthode de calcul dans l'objet résultat qui sera renvoyé
        ;
        $normalizers = [
            new ObjectNormalizer(),
        ];

        $encoders =[
            new JsonEncoder(),
        ];

        $serializer = new Serializer($normalizers,$encoders);
        $SerData = $serializer->serialize($resultat, 'json');

        $response = new Response($SerData);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    #[Route('/tca/{fichier}/{visio}', name: 'app_tca_param_API')]
    public function resultatTCAParam(int $fichier, int $visio){

        $service = new Service(); // On crée la classe service qui nous permettra d'appeler les méthodes de calcul
        $gain = $service->calculGainTCAParam($fichier,$visio); // On appelle la méthode de calcul correspondante a la route

        $resultat = new Result();
        $resultat
            ->setTitle('Gain Teleconsultation assistee')
            ->setResultat($gain) // On stocke le résultat de la méthode de calcul dans l'objet résultat qui sera renvoyé
        ;
        $normalizers = [
            new ObjectNormalizer(),
        ];

        $encoders =[
            new JsonEncoder(),
        ];

        $serializer = new Serializer($normalizers,$encoders);
        $SerData = $serializer->serialize($resultat, 'json');

        $response = new Response($SerData);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }



    #[Route('/te', name: 'app_te_API')]
    public function resultatTE()
    {
        $service = new Service();
        $gain = $service->calculGainTE();


        $resultat = new Result();
        $resultat
            ->setTitle('Gain Teleexpertise')
            ->setResultat($gain)
        ;
        $normalizers = [
            new ObjectNormalizer(),
        ];

        $encoders =[
            new JsonEncoder(),
        ];

        $serializer = new Serializer($normalizers,$encoders);
        $SerData = $serializer->serialize($resultat, 'json');

        $response = new Response($SerData);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }


    #[Route('/te/{fichier}/{visio}', name: 'app_te_param_API')]
    public function resultatTEParam(int $fichier, int $visio){

        $service = new Service(); // On crée la classe service qui nous permettra d'appeler les méthodes de calcul
        $gain = $service->calculGainTEParam($fichier,$visio); // On appelle la méthode de calcul correspondante a la route

        $resultat = new Result();
        $resultat
            ->setTitle('Gain Teleexpertise ')
            ->setResultat($gain) // On stocke le résultat de la méthode de calcul dans l'objet résultat qui sera renvoyé
        ;
        $normalizers = [
            new ObjectNormalizer(),
        ];

        $encoders =[
            new JsonEncoder(),
        ];

        $serializer = new Serializer($normalizers,$encoders);
        $SerData = $serializer->serialize($resultat, 'json');

        $response = new Response($SerData);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }



}

