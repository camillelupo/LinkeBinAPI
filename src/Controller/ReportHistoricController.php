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
use OpenApi\Annotations as OA;


class ReportHistoricController extends AbstractController
{
    /**
     * @Route("/report/historic", name="report_historic")
     * @OA\Get(
     *     path="/report/historic",
     *    summary="Index of report historic",
     *    tags={"reporthistoric"},
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
            'path' => 'src/Controller/ReportHistoricController.php',
        ]);
    }



    /**
     * @Route("/ReportHistoricDegradation/{idBin}/{idUser}/{Degradation}", name="AddReportHistoric")
     * @OA\Post(
     *    path="/AddReportHistoric/{idBin}/{idUser}",
     *    summary="Add report historic",
     *    operationId="add Report Historic",
     *    tags={"reporthistoric"},
     *    @OA\Parameter(
     *         name="idBin",
     *         in="path",
     *         description="ID of bin",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="idUser",
     *         in="path",
     *         description="ID of user",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(ref="#/components/schemas/reporthistoric",example="
     *         id: 50,
     *         uuid_users_bin: 05,
     *         created_at: 2020-01-20T09:47:53.086Z,
     *         degradation: true,
     *         bin_full: true,
     *         missing: false")
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
    public function ReportHistoricDegradation($idBin, $idUser, $Degradation): Response{


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
    /**
     * @Route("/ReportHistoricFull/{idBin}/{idUser}/{full}", name="AddReportHistoric")
     */
    public function ReportHistoricFull($idBin, $idUser, $full): Response{


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
        $reportHistoric->setBinFull($full);
        $usersBin->setReportFull($full);

        $entityManager->persist($bin);
        $entityManager->persist($users);
        $entityManager->persist($usersBin);
        $entityManager->persist($reportHistoric);


        $entityManager->flush();
        return new Response("BinsHistoric crée");
    }
    /**
     * @Route("/ReportHistoricMissing/{idBin}/{idUser}/{Missing}", name="AddReportHistoric")
     */
    public function ReportHistoricMissing($idBin, $idUser, $Degradation): Response{


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
