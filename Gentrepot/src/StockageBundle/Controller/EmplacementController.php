<?php

namespace StockageBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use StockageBundle\Entity\Emplacement;
use StockageBundle\Entity\Entrepot;
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
            return $this->redirectToRoute("stockage_listeEmplacement");

        }
        return $this->render("@Stockage/Emplacement/listeEmplacement.html.twig",array("form"=> $form->createView()));

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

    public function afficherAction()
    {
        $emplacements= $this->getDoctrine()-> getRepository(Emplacement::class)-> findAll();

        return $this->render("@Stockage/Emplacement/listeEmplacement.html.twig",array ('emplacements'=>$emplacements));
    }
    public function supprimerEmplacementAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $emplacement= $em->getRepository(Emplacement::class)->find($id);
        $em->remove($emplacement);
        $em->flush();
        return $this->redirectToRoute('stockage_listeEmplacement');
    }
    public function modifierEmplacementAction(Request $request, $id)
    {
        $em=$this->getDoctrine()->getManager();
        $emplacement = $em->getRepository(Emplacement::class)->find($id);


        //third step:
        // check is the from is sent
        if ($request->isMethod('POST')) {
            //update our object given the sent data in the request
            $emplacement = $em->getRepository(Emplacement::class)->find($id);
            $emplacement ->setAdresse($request->get('adresse'));
            $emplacement ->setCapaciteStockage($request->get('capaciteStockage'));
            $emplacement ->setQuantiteStocker($request->get('quantiteStocker'));
            $emplacement ->setClasse($request->get('classe'));
            //fresh the data base
            $em->flush();
            return $this->redirectToRoute("stockage_listeEmplacement");

        }
        //second step:
        // send the view to the user
        return $this->render('@Stockage/Emplacement/modifierEmplacement.html.twig', array('emplacement' => $emplacement));
    }

}
