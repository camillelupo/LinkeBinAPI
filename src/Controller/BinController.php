<?php

namespace App\Controller;

use App\Entity\Bin;
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
     * @OA\Post(
     *    path="/bins",
     *    summary="Create a bin",
     *    operationId="createBins",
     *    tags={"bins"},
     *    @OA\Response(response=201, description="Null response"),
     *    @OA\Response(
     *        response="default",
     *        description="unexpected error",
     *        @OA\Schema(ref="#-components-schemas-Error")
     *    )
     * )
     */
    public function addBin(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();




    }
}
