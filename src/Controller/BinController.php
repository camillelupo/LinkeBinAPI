<?php

namespace App\Controller;

use App\Entity\Bin;
use App\Entity\City;
use App\Entity\CityBin;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations\OpenApi;

class BinController extends AbstractController
{
    /**
     *  @OA\Get(
     *     path="/bin",
     *     summary="index of bins",
     *     operationId="indexBins",
     *     tags={"bins"},
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             format="int32"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="An paged array of bins",
     *         @OA\Schema(ref="#-components-schemas-Bins"),
     *         @OA\Header(header="x-next", @OA\Schema(type="string"), description="A link to the next page of responses")
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="unexpected error",
     *         @OA\Schema(ref="#-components-schemas-Error")
     *     )
     * )
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
            $city = $this->getDoctrine()
                ->getRepository(City::class)
                ->find($id);
        }

        echo($status);



        foreach ($json['features'] as $value) {

            if (isset($value['properties']['geo_point_2d'])) {

                $coords = $value['properties']['geo_point_2d'][1]." ".$value['properties']['geo_point_2d'][0];
                $commune = $value['properties']['commune'];
                $adresse = $value['properties']['adresse'];



            }

           $oneBin = $this->getDoctrine()
                ->getRepository(Bin::class)
                ->findOneby(["coords" => "POINT($coords)"]);


            if(!isset($oneBin)) {

                $bin = new bin();
                $cityBin = new cityBin();

                $bin->setCoords("POINT($coords)");

                $bin->setCity($commune);
                $bin->setAdress($adresse);
                $bin->setIsEnable(true);
                $bin->addCityBin($cityBin);
                $city->addCityBin($cityBin);


                $entityManager = $this->getDoctrine()->getManager();
                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $entityManager->persist($bin);
                $entityManager->persist($cityBin);
                $entityManager->persist($city);


            }else{
                return new Response("Bins déja présentes dans la bases de Donnés");
            }
        }
        $entityManager->flush();


        return new Response(" Bins ajoutés à la base de données");

    }
}
