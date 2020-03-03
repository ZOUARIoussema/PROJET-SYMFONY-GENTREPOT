<?php

namespace StockageBundle\Controller;

use StockageBundle\Entity\LignePerte;
use StockageBundle\Entity\Perte;
use StockageBundle\Form\LignePerteType;
use StockageBundle\Form\PerteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PerteController extends Controller
{
    public function passerPerteAction(Request $request)
    {

        $perte = new Perte();
        $form = $this->createForm(PerteType::class, $perte);
        $form->handleRequest($request);
        $lperte = new LignePerte();
        $f = $this->createForm(LignePerteType::class, $lperte);
        $f->handleRequest($request);

        if ($f->isSubmitted() || $form->isSubmitted()) {
            $choix = $request->get('bt');
            if ($choix == "DATE DU JOUR") {
                $em = $this->getDoctrine()->getManager();
                $perte->setDateCreation(new \DateTime('now'));
                $em->persist($perte);
                $em->flush();
                return $this->render("@Stockage/Perte/passerPerte.html.twig", array('perte' => $perte, 'lperte' => $lperte, "form" => $form->createView(), "f" => $f->createView()));
            } elseif ($choix == "PERDU") {

                $em = $this->getDoctrine()->getManager();
                $em->persist($lperte);
                $em->flush();
            }
        }
        return $this->render("@Stockage/Perte/passerPerte.html.twig", array('perte'=>$perte,'lperte'=>$lperte,"form" => $form->createView(), "f" => $f->createView()));
    }
    public function supprimerLignePerteTempAction(Request $request,$id){
        $session = $request->getSession();
        if(!$session->has('perte'))
        {
            $session->set('perte',array());
        }
        $Tabper = $session->get('perte',[]);
        if(!empty($Tabper[$id])){
            unset($Tabper[$id]);
        }
        $session->set('perte',$Tabper);
        return $this->redirectToRoute("stockage_passerPerte");
    }


    public function listePerteAction(){
        $pertes = $this->getDoctrine()->getRepository(Perte::class)->findAll();
        $lpertes = $this->getDoctrine()->getRepository(LignePerte::class)->findAll();
        return $this->render('@Stockage/Perte/listePerte.html.twig', array('pertes' => $pertes,'Tablper' => $lpertes));

    }

}
