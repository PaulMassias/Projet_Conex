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

