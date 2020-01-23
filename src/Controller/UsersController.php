<?php

namespace App\Controller;


use App\Entity\Users;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @Route("/users", name="users")
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


    /**
     * @Route("/findUser/{user_id}", name="findUser")
     */
    public function findUser($user_id)
    {
        $user = $this->getDoctrine()
            ->getRepository(Users::class)
            ->findOneByUserID($user_id);


        $userId = $user[0]['id'];
        $array = array(
            'id'=>$userId
        );
        $json = json_encode($array, true);
        $response  = new Response($json);
        $response->headers->set('Content-type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin','*');
        return $response;

    }
}
