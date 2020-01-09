<?php

namespace App\Controller;

use App\Entity\Bin;
use App\Entity\City;
use App\Entity\CityBin;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BinController extends AbstractController
{
    /**
     * @Route("/bin", name="bin")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/BinController.php',
        ]);
    }

    /**
     * @Route("/AddCityBins/{id}", name="AddCityBins")
     */

    public function addAllBins($id): Response
    {


        /*$entityManager = $this->getDoctrine()->getManager();*/
        $city = $this->getDoctrine()
            ->getRepository(City::class)
            ->find($id);
        $json = $city->getFileJson();

        $bin = new bin();

        //Requete permettant d'ajouter les bin en fonction du json de la ville

        //ajout dans la table jointure
        /*$cityBin = new cityBin();
        $cityBin->setUuidCity($id);*/

      /*  // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($cityBin);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();*/


        $lat =$json['features'][0]['properties']['geo_point_2d'][0];
        $lon =$json['features'][0]['properties']['geo_point_2d'][1];
        echo "<pre>";
        var_dump($lat);
        var_dump($lon);
        echo "</pre>";




        $entityManager = $this->getDoctrine()->getManager();

        return new Response();

    }
}
