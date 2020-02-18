<?php

namespace logistiqueBundle\Controller;

use logistiqueBundle\Entity\vehicule;
use logistiqueBundle\Form\vehiculeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@logistique/Default/index.html.twig');
    }
    public function ajoutvehiculeAction(Request $request){

        $vehicule= new vehicule();
        $form = $this->createForm(vehiculeType::class,$vehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $em= $this->getDoctrine()->getManager();
            $em-> persist($vehicule);
            $em->flush();

            return $this->redirectToRoute('vehiculeaff');
        }

        return $this->render("@logistique/Default/ajoutV.html.twig",array('form'=>$form->createView()));
    }
    public function affichevehiculeAction(){
        $em= $this->getDoctrine()->getManager();
        $vehicule = $em->getRepository("logistiqueBundle:vehicule")->findAll();
        return $this->render('@logistique/Default/afficheV.html.twig',array('vehicule'=>$vehicule));
    }
    public function  deletevAction($id){
        $em=$this->getDoctrine()->getManager();
        $vehicule = $em->getRepository("logistiqueBundle:vehicule")->find($id);
        $em->remove($vehicule);
        $em->flush();
        return $this->redirectToRoute('vehiculeaff');

    }
    public function modifierAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $variable=$em->getRepository(vehicule::class)->find($id);
        $form = $this->createForm(vehiculeType::class,$variable);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($variable);
            $em->flush();
            return $this->redirectToRoute('vehiculeaff');
        }
        return $this->render('@logistique/Default/updatev.html.twig',array('form'=>$form->createView()));
    }
}
