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
     *         description="Display index of city",
     *         @OA\Schema(ref="#/components/schemas/City"),
     *         @OA\Header(header="x-next", @OA\Schema(type="string"), description="A link to the next page of responses")
     *     ),
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
     *    tags={"city"},
     *     @OA\Response(
     *         response=200,
     *         description="Create a new city",
     *         @OA\Schema(ref="#/components/schemas/Cities"),
     *         @OA\Header(header="x-next", @OA\Schema(type="string"), description="A link to the next page of responses")
     *     ),
     *    @OA\Response(response=201, description="Null response"),
     *    @OA\Response(
     *        response="default",
     *        description="unexpected error",
     *        @OA\Schema(ref="#/components/schemas/Error")
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
