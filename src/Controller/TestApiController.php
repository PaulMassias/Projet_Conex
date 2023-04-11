<?php

namespace App\Controller;

use App\Classe\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestApiController extends AbstractController
{
    public function apiCall(String $route, float $fichier = null, float $visio = null ) : String{
        
        switch ($route) {
            case 'tc':
                $response = $this->forward('App\Controller\MainAPIController::resultatTCParam', ['fichier'=> $fichier, 'visio'=> $visio ]);
                break;
            case 'te':
                $response = $this->forward('App\Controller\MainAPIController::resultatTEParam', ['fichier'=> $fichier, 'visio'=> $visio ]);
                break;
            case 'tca':
                $response = $this->forward('App\Controller\MainAPIController::resultatTCAParam', ['fichier'=> $fichier, 'visio'=> $visio ]);
                break;

            default:
                break;
        }
        $resultat = json_decode($response->getContent())->resultat;
        return $resultat;
    }



    #[Route('/test/api', name: 'app_test_api')]
    public function index(Service $service): Response
    {
        return $this->render('test_api/index.html.twig', [
            'marge_erreur' => 0.03,

            'tc1' => $this->apiCall('tc',0.039,10),
            'tc1_attendu' => 3.85,

            'tc2' => $this->apiCall('tc',4,20),
            'tc2_attendu' => 3.45,

            'te1' => $this->apiCall('te',8,0),
            'te1_attendu' => 10.56,

            'te2' => $this->apiCall('te',4,30),
            'te2_attendu' => 10.96,

            'tca1' => $this->apiCall('tca',0.019,10),
            'tca1_attendu' => 2.16,

            'tca2' => $this->apiCall('tca',4.20,20),
            'tca2_attendu' => 1.76,

        ]);
    }
}
