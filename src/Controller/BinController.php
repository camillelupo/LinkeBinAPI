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


        // Initialize an URL to the variable
        $url = "http://angotbaptiste.com/verre.geojson";
        // Use get_headers() function
            $headers = @get_headers($url);
        print_r($headers);
        // Use condition to check the existence of URL
        if(empty($headers) || strpos( $headers[0], '404')) {
            $status = "URL Doesn't Exist";
            $city = $this->getDoctrine()
                ->getRepository(City::class)
                ->find($id);
            $json = $city->getFileJson();
        }
        else {
            $raw = file_get_contents($url);
            $json = json_decode($raw,true);
            $status = "URL Exist";
        }

        echo($status);


        /*$entityManager = $this->getDoctrine()->getManager();*/




        //Requette permettant d'ajouter les bin en fonction du json de la ville

        //ajout dans la table jointure
        /*$cityBin = new cityBin();
        $cityBin->setUuidCity($id);*/

        /*  // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($cityBin);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();*/
     /*   echo "<pre>";
        print_r($json);
        echo "</pre>";*/
        foreach ($json['features'] as $value) {

            if (isset($value['properties']['geo_point_2d'])) {

                $coords = $value['properties']['geo_point_2d'][1]." ".$value['properties']['geo_point_2d'][0];
                $commune = $value['properties']['commune'];
                $adresse = $value['properties']['adresse'];

            }

            $bin = new bin();
         $bin->setCoords("POINT($coords)");

                      $bin->setCity($commune);
                      $bin->setAdress($adresse);
                      $bin->setIsEnable(true);


                      $entityManager = $this->getDoctrine()->getManager();
                        // tell Doctrine you want to (eventually) save the Product (no queries yet)
               $entityManager->persist($bin);


        }
        $entityManager->flush();
        return new Response(" Bins ajoutés à la base de données");
    }
}
