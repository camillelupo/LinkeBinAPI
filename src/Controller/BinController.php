<?php

namespace App\Controller;

use App\Entity\Bin;
use App\Entity\City;
use App\Entity\CityBin;
use App\Entity\BinHistoric;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class BinController extends AbstractController
{
    /**
     * @Route("/bin", name="bin")
     * @OA\Get(
     *     path="/bin",
     *    summary="Index of bin",
     *    tags={"bin"},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(example="Welcome to your new controller!",@OA\Schema(type="string"))
     *     ),
     *     @OA\Response(
     *          response=403,
     *     description="Access denied"
     *    ),
     *    @OA\Response(
     *     response=404,
     *     description="Not found"
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
     * @Route("/bins/getAllBins", name="getAllBins", methods={"GET"})
     * @OA\Get(
     *    path="/bins/getAllBins",
     *    summary="Display all bins",
     *    operationId="displayBins",
     *    tags={"bin"},
     *    @OA\Parameter(
     *         name="Adress",
     *         in="path",
     *         description="Adress of bin",
     *         required=true,
     *         @OA\Schema(
     *              type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="City",
     *         in="path",
     *         description="City of bin",
     *         required=true,
     *         @OA\Schema(
     *              type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="Coord",
     *         in="path",
     *         description="Coordonates of bin",
     *         required=true,
     *         @OA\Schema(
     *              type="string"
     *         )
     *    ),
     *    @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/bin",example="Bin on map")
     *    ),
     *    @OA\Response(
     *          response=403,
     *          description="Access denied"
     *    ),
     *    @OA\Response(
     *          response=404,
     *          description="Not found"
     *     )
     * )
     */
        public function getAllBins(){

            $array = $this->getDoctrine()
                ->getRepository(Bin::class)
                ->findAllBins();

            $coordresult = array(
                        "type" => "FeatureCollection",
                "features" => [

            ]

            );
            foreach ($array as $value)
            {
                $value['properties'] = array(
                   "adress" => $value['adress'],
                    "commune" => $value['city']) ;
                $coord = str_replace(array('SRID=4326;POINT(',')'),'',$value['coords']);
                $arraycoord = explode(' ',$coord);
                $value['geometry'] = array(
                    "type" => "Point",
                    "coordinates" => $arraycoord);
                $coordresult['features'][] = $value;
            }
            $result = json_encode($coordresult, true);
            $response  = new Response(
                $result
            );
            $response->headers->set('Content-type', 'application/json');
            $response->headers->set('Access-Control-Allow-Origin','*');
            return $response;

        }


     /**
     * @Route("/AddCityBins/{id}", name="AddCityBins")
     * @OA\Post(
     *    path="/AddCityBins/{id}",
     *    summary="Add all bins",
     *    operationId="createBins",
     *    tags={"bin"},
     *    @OA\Parameter(
     *         name="ID",
     *         in="query",
     *         description="ID of bin",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="Url",
     *         in="header",
     *         description="Url of api",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/bin",example="
     *         id: 0,
     *         coords: 92.7667 87.4376,
     *         city: Toulouse,
     *         adress: 402 rue des tilleuls,
     *         is_enable: true,
     *         created_at: 2020-01-20T09:47:53.086Z,
     *         updated_at: 2020-01-20T09:47:53.086Z,
     *         user_bin: 42,
     *         bin_historics: 50,
     *         cityBins: 64")
     *      ),
     *    @OA\Response(
     *          response=403,
     *     description="Access denied"
     *    ),
     *    @OA\Response(
      *     response=404,
      *     description="Url doesn't exist",
      *     @OA\JsonContent(example="URL Doesn't Exist")
      *    ),
      *    @OA\Response(
      *     response="default",
      *     description="Bin already here",
      *     @OA\JsonContent(example="Bins déja présentes dans la bases de Donnés")
      *    )
     * )
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
                $binHistoric = new binHistoric();

                $bin->setCoords("POINT($coords)");

                $bin->setCity($commune);
                $bin->setAdress($adresse);
                $bin->setIsEnable(true);
                $bin->addCityBin($cityBin);
                $city->addCityBin($cityBin);
                $bin->addBinHistoric($binHistoric);



                $entityManager = $this->getDoctrine()->getManager();
                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $entityManager->persist($bin);
                $entityManager->persist($cityBin);
                $entityManager->persist($city);
                $entityManager->persist($binHistoric);


            }else{
                return new Response("Bins déja présentes dans la bases de Donnés");
            }
        }
        $entityManager->flush();


        return new Response(" Bins ajoutés à la base de données");

    }
}
