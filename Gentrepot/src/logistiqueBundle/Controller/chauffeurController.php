<?php

namespace logistiqueBundle\Controller;

use logistiqueBundle\Entity\chauffeur;
use logistiqueBundle\Form\chauffeurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class chauffeurController extends Controller
{

    public function ajoutchaufAction(Request $request){

        $chauffeur= new chauffeur();
        $form = $this->createForm(chauffeurType::class,$chauffeur);
        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $em= $this->getDoctrine()->getManager();
            $chauffeur->setEtat('disponible');
            $chauffeur->setVoyage(0);

            $em-> persist($chauffeur);
            $em->flush();

            return $this->redirectToRoute('chauffeuraff');
        }

        return $this->render("@logistique/chauffeur/ajoutch.html.twig",array('form'=>$form->createView()));
    }
    public function chauffeuraffAction(){
        $em= $this->getDoctrine()->getManager();
        $chauffeur = $em->getRepository("logistiqueBundle:chauffeur")->findAll();
        return $this->render('@logistique/chauffeur/affichechauf.html.twig',array('chauffeur'=>$chauffeur));
    }
    public function  deletechaufAction($cin){
        $em=$this->getDoctrine()->getManager();
        $chauff = $em->getRepository("logistiqueBundle:chauffeur")->find($cin);
        $em->remove($chauff);
        $em->flush();
        return $this->redirectToRoute('chauffeuraff');

    }
    public function updatechaufAction($cin,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $variable=$em->getRepository(chauffeur::class)->find($cin);
        $form = $this->createForm(chauffeurType::class,$variable);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($variable);
            $em->flush();
            return $this->redirectToRoute('chauffeuraff');
        }
        return $this->render('@logistique/chauffeur/updatechauf.html.twig',array('form'=>$form->createView()));
    }
}
