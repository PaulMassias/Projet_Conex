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
use OpenApi\Annotations as OA;


class MainAPIController extends AbstractController
{

/**
 * @OA\Get(
 *      path="/tc",
 *      operationId="resultatTCDefaut",
 *      tags={"Teleconsultation"},
 *      summary="Calculer le gain de la téléconsultation avec des paramètres par défaut (2 Mo et 10 minutes)",
 *      description="Cette route permet de calculer le gain de la téléconsultation avec des valeurs par défaut pour les paramètres `fichier` à 2Mo et `visio` à 10 minutes.",
 *      @OA\Response(
 *          response=200,
 *          description="Retourne le gain de la téléconsultation",
 *          @OA\JsonContent(
 *              @OA\Property(property="title", type="string", example="Gain Teleconsultation"),
 *              @OA\Property(property="resultat", type="number", example=3.6579295)
 *          )
 *      )
 * )
 * @OA\Get(
 *      path="/tc/{fichier}/{visio}",
 *      operationId="resultatTCParam",
 *      tags={"Teleconsultation"},
 *      summary="Calculer le gain de la téléconsultation avec des paramètres personnalisés",
 *      description="Cette route permet de calculer le gain de la téléconsultation avec des valeurs personnalisés pour les paramètres `fichier` et `visio`.",
 *      @OA\Parameter(
 *          name="fichier",
 *          in="path",
 *          description="Taille en Mo du fichiers partagés pendant la téléconsultation",
 *          @OA\Schema(type="number")
 *      ),
 *      @OA\Parameter(
 *          name="visio",
 *          in="path",
 *          description="Durée en minutes de la téléconsultation",
 *          @OA\Schema(type="number")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Retourne le gain de la téléconsultation",
 *          @OA\JsonContent(
 *              @OA\Property(property="title", type="string", example="Gain Teleconsultation"),
 *              @OA\Property(property="resultat", type="number", example=3.6579295)
 *          )
 *      )
 * )
 */

    #[Route('/tc/{fichier}/{visio}', name: 'app_tc_param_API')]
    public function resultatTCParam(float $fichier = 2, float $visio = 10){

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


/**
 * @OA\Get(
 *      path="/tca",
 *      operationId="resultatTCADefaut",
 *      tags={"Teleconsultation assistee"},
 *      summary="Calculer le gain de la téléconsultation assistee avec des paramètres par défaut (2 Mo et 10 minutes)",
 *      description="Cette route permet de calculer le gain de la téléconsultation assistee avec des valeurs par défaut pour les paramètres `fichier` à 2 Mo et `visio` à 10 minutes.",
 *      @OA\Response(
 *          response=200,
 *          description="Retourne le gain de la teleconsultation assistee",
 *          @OA\JsonContent(
 *              @OA\Property(property="title", type="string", example="Gain Teleconsultation assistee"),
 *              @OA\Property(property="resultat", type="number", example=1.9691794999999999)
 *          )
 *      )
 * )
 * @OA\Get(
 *      path="/tca/{fichier}/{visio}",
 *      operationId="resultatTCAParam",
 *      tags={"Teleconsultation assistee"},
 *      summary="Calculer le gain de la téléconsultation assistee avec des paramètres personnalisés",
 *      description="Cette route permet de calculer le gain de la téléconsultation assistee avec des valeurs personnalisées pour les paramètres `fichier` et `visio`.",
 *      @OA\Parameter(
 *          name="fichier",
 *          in="path",
 *          description="Taille en Mo du fichiers partagés pendant la téléconsultation assistee",
 *          @OA\Schema(type="number")
 *      ),
 *      @OA\Parameter(
 *          name="visio",
 *          in="path",
 *          description="Durée en minutes de la téléconsultation assistee",
 *          @OA\Schema(type="number")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Retourne le gain de la teleconsultation assistee",
 *          @OA\JsonContent(
 *              @OA\Property(property="title", type="string", example="Gain Teleconsultation assistee"),
 *              @OA\Property(property="resultat", type="number", example=1.9691794999999999)
 *          )
 *      )
 * )
 * 
 * 
 */
    #[Route('/tca/{fichier}/{visio}', name: 'app_tca_param_API')]
    public function resultatTCAParam(float $fichier = 2, float $visio = 10){

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

/**
 * @OA\Get(
 *      path="/te",
 *      operationId="resultatTEDefaut",
 *      tags={"Téléexpertise"},
 *      summary="Calculer le gain de la téléexpertise avec des paramètres par défaut (2 Mo et 10 minutes)",
 *      description="Cette route permet de calculer le gain de la téléexpertise avec des valeurs par défaut pour les paramètres `fichier` à 2 Mo et `visio` à 10 minutes.",
 *      @OA\Response(
 *          response=200,
 *          description="Retourne le gain de la téléexpertise",
 *          @OA\JsonContent(
 *              @OA\Property(property="title", type="string", example="Gain Teleexpertise"),
 *              @OA\Property(property="resultat", type="number", example=11.1656295)
 *          )
 *      )
 * )
 * @OA\Get(
 *      path="/te/{fichier}/{visio}",
 *      operationId="resultatTEParam",
 *      tags={"Téléexpertise"},
 *      summary="Calculer le gain de la téléexpertise avec des paramètres personnalisées",
 *      description="Cette route permet de calculer le gain de la téléexpertise avec des valeurs personnalisées pour les paramètres `fichier` et `visio`.",
 *      @OA\Parameter(
 *          name="fichier",
 *          in="path",
 *          description="Taille en Mo du fichiers partagés pendant la téléexpertise",
 *          @OA\Schema(type="number")
 *      ),
 *      @OA\Parameter(
 *          name="visio",
 *          in="path",
 *          description="Durée en minutes de la téléexpertise",
 *          @OA\Schema(type="number")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Retourne le gain de la téléexpertise",
 *          @OA\JsonContent(
 *              @OA\Property(property="title", type="string", example="Gain Teleexpertise"),
 *              @OA\Property(property="resultat", type="number", example=11.1656295)
 *          )
 *      )
 * )
 */
    #[Route('/te/{fichier}/{visio}', name: 'app_te_param_API')]
    public function resultatTEParam(float $fichier = 2, float $visio = 10){

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