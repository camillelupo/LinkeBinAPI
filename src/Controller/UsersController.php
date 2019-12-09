<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

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
     * @Route("/user", name="create_user")
     */
    public function createUser(): Response{
        $entityManager = $this->getDoctrine()->getManager();

        $user = new Users();
        $user->setCreatedAt(new \DateTime('now'));
        $user->setRole("user");
        $user->setName("camille");
        $user->setPassword("clodo");
        $user->setToken("erzrr");
        $user->setMail("fzfzf");
        $user->setIsEnable(true);

        $entityManager->persist($user);

        $entityManager->flush();

        return new Response('Saved new product with id '.$user->getId());

    }
}
