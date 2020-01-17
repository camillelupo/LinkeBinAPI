<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\City;
use OpenApi\Annotations\OpenApi

class CityController extends AbstractController
{
    /**
     * @Route("/city", name="city")
     *  @OA\Get(
     *     path="/city",
     *     summary="index of cities",
     *     operationId="indexCities",
     *     tags={"cities"},
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
     *         description="An paged array of cities",
     *         @OA\Schema(ref="#-components-schemas-Cities"),
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
            'path' => 'src/Controller/CityController.php',
        ]);
    }

    /**
     * @Route("/addCity", name="addCity")
     * @OA\Post(
     *    path="/cities",
     *    summary="Create a city",
     *    operationId="createCities",
     *    tags={"cities"},
     *    @OA\Response(response=201, description="Null response"),
     *    @OA\Response(
     *        response="default",
     *        description="unexpected error",
     *        @OA\Schema(ref="#-components-schemas-Error")
     *    )
     * )
     */
    public function createCity(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $city = new City();
        $city->setName('test');
        $city->setIsEnable(true);

        $raw = file_get_contents('C:\Users\17359\PhpstormProjects\LinkeBinAPI\Bornes_a_verre(1).json');
        $json = json_decode($raw,true);
        $city->setFileJson($json);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($city);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new city with id '.$city->getId());
    }
}
