<?php

namespace App\Controller;


use App\Entity\Users;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
     * @OA\Get(
     *     path="/users",
     *    summary="Index of users",
     *    tags={"user"},
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
            'path' => 'src/Controller/UsersController.php',
        ]);
    }


    /**
     * @Route("/AddUser/{id}", name="AddUser")
     * @OA\Post(
     *    path="/AddUser/{id}",
     *    summary="Add all users",
     *    operationId="createUsers",
     *    tags={"user"},
     *    @OA\Parameter(
     *         name="ID",
     *         in="path",
     *         description="ID of user",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="Token",
     *         in="header",
     *         description="Token pour l'utilisateur",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/users",example="
     *         id: 29,
     *         user_id: 05,
     *         created_at: 2020-01-20T09:47:53.086Z,
     *         updated_at: 2020-01-20T09:47:53.086Z,
     *         token: dsqsdqsd,
     *         is_enable: true,
     *         user_bin: 64")
     *      ),
     *    @OA\Response(
     *          response=403,
     *     description="Access denied"
     *    ),
     *    @OA\Response(
     *     response=404,
     *     description="Not found"
     *    )
     * )
     */
    public function createUser($id): response{

        $entityManager = $this->getDoctrine()->getManager();
        $users = new users();
        $users->setUserId($id);
        $users->setIsEnable(true);
        $users->setToken("dsqsdqsd");

        $entityManager->persist($users);
        $entityManager->flush();
        return new Response("User cree");
    }
}
