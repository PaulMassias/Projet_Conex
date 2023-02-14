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
        $consoDeplacementMed = 0.193*10*2;

        $consoTelemedecine = 0.0008515;
        $consoFichier = 0.1;
        $consoVisio = 0.000125;
        
        $emission = $consoTelemedecine + $consoFichier + $consoVisio;
        
        $gain = $consoDeplacementMed - $emission;

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

    #[Route('/tca', name: 'app_tc_API')]
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



    #[Route('/main', name: 'app_main_API')]
    public function showAction()
    {
        $service = new Service();
        $paramStringed = $service->getParam();
        $param = json_decode($paramStringed);

        var_dump($param);

        $resultat = new Result();
        $resultat
            ->setTitle('Mon premier resultat')
            ->setResultat(3.28)
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



    #[Route('/main2', name: 'app_main_API2')]
    public function showAction2()
    {

        $resultat = new Result();
        $resultat
            ->setTitle('Mon second resultat')
            ->setResultat(5.58)
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

