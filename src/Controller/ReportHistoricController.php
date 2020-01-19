<?php

namespace App\Controller;

use App\Entity\Bin;
use App\Entity\BinHistoric;
use App\Entity\ReportHistoric;
use App\Entity\UsersBin;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ReportHistoricController extends AbstractController
{
    /**
     * @Route("/report/historic", name="report_historic")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ReportHistoricController.php',
        ]);
    }

    /**
     * @Route("/AddReportHistoric/{id}", name="AddReportHistoric")
     */
    public function createReportHistoric($id): Response{


            $usersBin = new usersBin();
            $binHistoric = new BinHistoric();

        $bin = $this->getDoctrine()
            ->getRepository(Bin::class)
            ->find($id);

         $id =$bin->getId();



        return new Response("BinsHistoric crée");
    }
}
