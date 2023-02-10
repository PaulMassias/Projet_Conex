<?php

namespace App\Controller;

use App\Entity\TcResult;
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

        $resultat = new TcResult();
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

    public function resultatTCParam($tailleFichier, $tempsVisio){
        $consoDeplacementMed = 0.193*10*2;

        $consoTelemedecine = 0.0008515;
        $consoFichier = 0.1 * $tailleFichier;
        $consoVisio = 0.000125 * $tempsVisio;

        $emission = $consoTelemedecine + $consoFichier + $consoVisio;
        
        $resultat = $consoDeplacementMed - $emission;
        return $resultat;
    }


    #[Route('/main', name: 'app_main_API')]
    public function showAction()
    {
        $service = new Service();
        $paramStringed = $service->getParam();
        $param = json_decode($paramStringed);

        var_dump($param);

        $resultat = new TcResult();
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

        $resultat = new TcResult();
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

