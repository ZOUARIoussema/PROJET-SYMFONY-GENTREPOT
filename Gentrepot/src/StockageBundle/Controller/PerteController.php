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
        $session = $request->getSession();
        if(!$session->has('perte'))
        {
            $session->set('perte',array());
        }
        $Tabper = $session->get('perte',[]);

        if($f->isSubmitted()||$form->isSubmitted()) {
            $choix = $request->get('bt');
            if($choix == "Valider") {
                $em = $this->getDoctrine()->getManager();
                $lig = sizeof($Tabper);
                for ($i = 0; $i < $lig; $i++) {
                    $lperte = new LignePerte();
                    $lperte->setProduit($Tabper[$i]->getProduit()->getReference());
                    $lperte->setPerte($perte->getId());
                    $lperte->setQuantite($Tabper[$i]->getQuantite());
                    $lperte->setRaisonPerte($Tabper[$i]->getRaisonPerte());
                    $em->persist($lperte);
                    $em->flush();
                }
                $em->persist($perte);
                $em->flush();
                return $this->render("@Stockage/Perte/passerPerte.html.twig", array('perte'=>$perte,'lperte'=>$lperte,'lpertes'=>$Tabper,"form" => $form->createView(), "f" => $f->createView(),'lig'=>$lig));
            }
            elseif ($choix == "Add"){
                array_push($Tabper,$lperte);
                $lig = sizeof($Tabper)+1;
                $Tabper[$lig] = $lperte;
                $session->set('perte',$Tabper);
            }
            elseif ($choix == "Supprimer"){
                unset($Tabper[$lperte]);
            }

        }

        return $this->render("@Stockage/Perte/passerPerte.html.twig", array('perte'=>$perte,'lperte'=>$lperte,'lpertes'=>$Tabper,"form" => $form->createView(), "f" => $f->createView()));

    }
    public function listePerteAction(){
        $pertes = $this->getDoctrine()->getRepository(Perte::class)->findAll();
        $lpertes = $this->getDoctrine()->getRepository(LignePerte::class)->findAll();
        return $this->render('@Stockage/Perte/listePerte.html.twig', array('pertes' => $pertes,'Tablper' => $lpertes));

    }

}

