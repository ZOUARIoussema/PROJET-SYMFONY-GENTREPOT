<?php

namespace logistiqueBundle\Controller;

use logistiqueBundle\Entity\ordremission;
use logistiqueBundle\Form\ordremissionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ordremissionController extends Controller
{

    public function ajoutordreMAction(Request $request){

        $ordre= new ordremission();
        $form = $this->createForm(ordremissionType::class,$ordre);
        /*->add()->add('id_chauffeur')->add('id_aidechauff')*/
        // $form->add('id_vehicule',EntityType::class,['class'=>vehicule::class,'choice_label'=>'id_vehicule','multiple'=>false]);

        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $em= $this->getDoctrine()->getManager();
            $em-> persist($ordre);
            $em->flush();

            return $this->redirectToRoute('afficheordre');
        }

        return $this->render("@logistique/ordremission/ajoutordreM.html.twig",array('form'=>$form->createView()));
    }
    public function afficheordreAction(){
        $em= $this->getDoctrine()->getManager();
        $ordrem = $em->getRepository("logistiqueBundle:ordremission")->findAll();
        return $this->render('@logistique/ordremission/afficheordre.html.twig',array('ordremission'=>$ordrem));
    }
    public function updateMAction($id,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $variable=$em->getRepository(ordremission::class)->find($id);
        $form = $this->createForm(ordremissionType::class,$variable);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($variable);
            $em->flush();
            return $this->redirectToRoute('afficheordre');
        }
        return $this->render('@logistique/ordremission/updateM.html.twig',array('form'=>$form->createView()));
    }
    public function  deleteMAction($id){
        $em=$this->getDoctrine()->getManager();
        $M = $em->getRepository("logistiqueBundle:ordremission")->find($id);
        $em->remove($M);
        $em->flush();
        return $this->redirectToRoute('afficheordre');

    }
    public function PDFAction($id,Request $request)
    {
        $snappy = $this->get('knp_snappy.pdf');
        $em=$this->getDoctrine()->getManager();
        $html = $em->getRepository("logistiqueBundle:ordremission")->findBy(array('id'=>$id));


        $html = $this->renderView('@logistique/Default/template.html.twig', array(
            'date' => $html
        ));

        $filename = 'myFirstSnappyPDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }
}
