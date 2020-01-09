<?php

namespace App\Controller;

use App\Entity\Bin;
use App\Entity\City;
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

        $city = $this->getDoctrine()
            ->getRepository(City::class)
            ->find($id);


        $json = $city->getFileJson();


        var_dump($json);
        $entityManager = $this->getDoctrine()->getManager();

        return new Response(var_dump($json));


    }
}
