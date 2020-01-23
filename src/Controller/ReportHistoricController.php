<?php

namespace App\Controller;

use App\Entity\Users;
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
     * @Route("/AddReportHistoric/{idBin}/{idUser}/{Degradation}", name="AddReportHistoric")
     */
    public function createReportHistoric($idBin, $idUser, $Degradation): Response{


        $entityManager = $this->getDoctrine()->getManager();

        $users = $this->getDoctrine()
            ->getRepository(Users::class)
            ->find($idUser);


        $bin = $this->getDoctrine()
            ->getRepository(Bin::class)
            ->find($idBin);



            $usersBin = new usersBin();
            $reportHistoric = new reportHistoric();


            $bin->addUserBin($usersBin);
            $users->addUserBin($usersBin);
            $usersBin->addReportHistoric($reportHistoric);
        $reportHistoric->setDegradation($Degradation);


        $entityManager->persist($bin);
        $entityManager->persist($users);
        $entityManager->persist($usersBin);
        $entityManager->persist($reportHistoric);


        $entityManager->flush();
        return new Response("BinsHistoric crée");
    }
}
