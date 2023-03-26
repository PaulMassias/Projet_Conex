<?php

namespace App\Controller;

use App\Classe\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestApiController extends AbstractController
{
    #[Route('/test/api', name: 'app_test_api')]
    public function index(Service $service): Response
    {
        return $this->render('test_api/index.html.twig', [
            'tc1' => $service->calculGainTCParam(0.40,10),
            'tc1_attendu' => 3.8,

            'tc2' => $service->calculGainTCParam(4,20),
            'tc2_attendu' => 3.45,

            'te1' => $service->calculGainTEParam(8,null),
            'te1_attendu' => 10.6,

            'te2' => $service->calculGainTEParam(4,30),
            'te2_attendu' => 10.96,

            'tca1' => $service->calculGainTCAParam(0.20,10),
            'tca1_attendu' => 2.14,

            'tca2' => $service->calculGainTCAParam(4.20,20),
            'tca2_attendu' => 1.74,

            'marge_erreur' => 0.05,
        ]);
    }
}
