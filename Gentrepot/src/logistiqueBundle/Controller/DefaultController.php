<?php

namespace logistiqueBundle\Controller;

use logistiqueBundle\Entity\ordremission;
use logistiqueBundle\Entity\vehicule;
use logistiqueBundle\Form\vehiculeType;
use Symfony\Component\HttpFoundation\Response;
use VenteBundle\Entity\BonLivraison;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use VenteBundle\Repository\BonLivraisonRepository;

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
    public function afficheBonAction(){
        $em= $this->getDoctrine()->getManager();
        /*$bon = $em->getRepository("VenteBundle:BonLivraison")->findallLivrasionBydate();
        $em=$this->getDoctrine()->getManager();

        foreach ($bon as $b ){
            $order = new ordremission();
            $order->setDatecreation(new \DateTime());
            $order->setDateretour(new \DateTime());

            $order->setDatesortie($b->getDatesortie());
            $em->persist($order);

            $em->flush($order);
        }*/
        $B= $em->getRepository("VenteBundle:BonLivraison")->findalllivrasion();

        return $this->render('@logistique/Default/afficheBon.html.twig',array('bon'=>$B));
    }

    public function PDFAction()
    {
        $snappy = $this->get('knp_snappy.pdf');

        $html = $this->renderView('logistiqueBundle:Default:template.html.twig', array(
            'title' => 'Hello World !'
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
