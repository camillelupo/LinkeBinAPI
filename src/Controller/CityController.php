<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\City;
use OpenApi\Annotations as OA;

class CityController extends AbstractController
{
    /**
     * @Route("/city", name="city")
     * @OA\Get(
     *     path="/city",
     *    summary="Index of city",
     *    tags={"city"},
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
            'path' => 'src/Controller/CityController.php',
        ]);
    }

    /**
     * @Route("/addCity", name="addCity")
     * @OA\Post(
     *    path="/addCity",
     *    summary="Create a city",
     *    operationId="createCities",
     *    tags={"city"},
     *     @OA\Parameter(
     *         name="Link",
     *         in="header",
     *         description="Link of json file",
     *         required=true,
     *         @OA\Schema(type="string")
     *    ),
     *    @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/city",example="
     *         id: 05,
     *         file_json: [ C:\Users\17359\PhpstormProjects\LinkeBinAPI\Bornes_a_verre(1).json ],
     *         name: Toulouse,
     *         region: Occitanie,
     *         departement: Haute-Garonne,
     *         cityBins: 109
     *         ")
     *    ),
     *    @OA\Response(
     *          response=403,
     *          description="Access denied"
     *    ),
     *    @OA\Response(
     *          response=404,
     *          description="Not found"
     *    )
     * )
     */
    public function createCity(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $city = new City();
        $city->setName('test');
        $city->setIsEnable(true);

        $raw = file_get_contents('C:\xampp\htdocs\LinkeBinAPI\toulouse.json');
        $json = json_decode($raw,true);
        $city->setFileJson($json);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($city);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new city with id '.$city->getId());
    }
}
