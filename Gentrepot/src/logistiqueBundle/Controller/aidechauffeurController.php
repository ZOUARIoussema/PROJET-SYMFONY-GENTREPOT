<?php

namespace logistiqueBundle\Controller;

use logistiqueBundle\Entity\aidechauffeur;
use logistiqueBundle\Form\aideChauffeurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class aidechauffeurController extends Controller
{

    public function ajoutAchaufAction(Request $request){

        $Achauffeur= new aidechauffeur();
        $form = $this->createForm(aidechauffeurType::class,$Achauffeur);
        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $em= $this->getDoctrine()->getManager();
            $em-> persist($Achauffeur);
            $em->flush();

            return $this->redirectToRoute('affaide');
        }

        return $this->render("@logistique/aidechauffeur/ajoutAchauf.html.twig",array('form'=>$form->createView()));
    }
    public function affaideAction(){
        $em= $this->getDoctrine()->getManager();
        $Achauf = $em->getRepository("logistiqueBundle:aidechauffeur")->findAll();
        return $this->render('@logistique/aidechauffeur/affaide.html.twig',array('aidechauffeur'=>$Achauf));
    }
    public function  deleteAchaufAction($cin){
        $em=$this->getDoctrine()->getManager();
        $achauff = $em->getRepository("logistiqueBundle:aidechauffeur")->find($cin);
        $em->remove($achauff);
        $em->flush();
        return $this->redirectToRoute('affaide');

    }
    public function updateAchaufAction($cin,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $variable=$em->getRepository(aidechauffeur::class)->find($cin);
        $form = $this->createForm(aidechauffeurType::class,$variable);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($variable);
            $em->flush();
            return $this->redirectToRoute('affaide');
        }
        return $this->render('@logistique/aidechauffeur/updateAchauf.html.twig',array('form'=>$form->createView()));
    }
}
