<?php

namespace StockageBundle\Controller;



use StockageBundle\Entity\LignePerte;
use StockageBundle\Entity\Perte;
use StockageBundle\Form\PerteType;
use StockageBundle\Form\LignePerteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PerteController extends Controller
{
    public function passerPerteAction(Request $request){
        $perte = new Perte();
        $form = $this->createForm(PerteType::class, $perte);
        $form->handleRequest($request);
        $lperte = new LignePerte();
        $f = $this->createForm(LignePerteType::class, $lperte);
        $f->handleRequest($request);

        if($f->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($lperte);
            $em->flush();
            return $this->redirectToRoute("stockage_listePerte");
        }
        if($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($perte);
            $em->flush();
            return $this->redirectToRoute("stockage_listePerte");
        }

        return $this->render("@Stockage/Perte/passerPerte.html.twig", array("form" => $form->createView(), "f" => $f->createView()));

    }
    public function listePerteAction(){
        $pertes = $this->getDoctrine()->getRepository(Perte::class)->findAll();
        $lpertes = $this->getDoctrine()->getRepository(LignePerte::class)->findAll();
        return $this->render('@Stockage/Perte/listePerte.html.twig', array('Tabpertes' => $pertes,'Tablpertes' => $lpertes));

    }

}
