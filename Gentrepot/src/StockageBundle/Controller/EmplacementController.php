<?php

namespace StockageBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use StockageBundle\Entity\Emplacement;
use StockageBundle\Form\EmplacementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class EmplacementController extends Controller
{

    public function ajouterEmplacementAction(Request $request )
    {

        $emplacement= new Emplacement();

        $form= $this->createForm(EmplacementType::class,$emplacement);
        $form->handleRequest($request);
        if ($form->isSubmitted()){

            $ef= $this->getDoctrine()->getManager();
            $ef->persist($emplacement);
            $ef->flush();
            // return $this->redirectToRoute("stockage_listEmplacement");

        }
        return $this->render("@Stockage/Emplacement/ajouterEmplacement.html.twig",array("form"=> $form->createView()));

    }
    public function indexAction()
    {
        $pieChart = new PieChart();
        $em= $this->getDoctrine();
        $emplacements = $em->getRepository(Emplacement::class)->findAll();
        $totalQuantiteStock=0;
        foreach($emplacements as $emplacement) {
            $totalQuantiteStock = $totalQuantiteStock + $emplacement->getQuantiteStocker();
        }

        $data= array();
        $stat=['classe', 'getQuantiteStocker()'];
        $nb=0;
        array_push($data,$stat);
        foreach($emplacements as $emplacement) {
            $stat=array();
            array_push($stat,$emplacement->getClasse(),(($emplacement->getQuantiteStocker()) *100)/$totalQuantiteStock);
            $nb=($emplacement->getQuantiteStocker() *100)/$totalQuantiteStock;
            $stat=[$emplacement->getClasse(),$nb];
            array_push($data,$stat);

        }

        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Pourcentages du stockage par classe');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);


        return $this->render('@Stockage\Emplacement\index.html.twig', array('piechart' => $pieChart));
    }

}
