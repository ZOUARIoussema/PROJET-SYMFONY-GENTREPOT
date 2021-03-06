<?php

namespace VenteBundle\Controller;

use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use VenteBundle\Controller\CartController;

use VenteBundle\Entity\BonLivraison;
use VenteBundle\Entity\CommandeVente;
use VenteBundle\Entity\FactureVente;
use VenteBundle\Entity\LigneCommande;
use VenteBundle\Form\BonLivraisonType;
use VenteBundle\Form\CommandeVenteType;
use VenteBundle\Form\LigneCommandeType;

class CommandeController extends Controller
{
    public function createAction(SessionInterface $session){

        $commande=new CommandeVente();

        $commande->setDateC(new \DateTime());
        $commande->setEtat("en cour");

        $lignecommande= new LigneCommande();

        $lignecommande->setCommande($commande);

        foreach (  CartController::$test as $item) {





        }
       // var_dump(CartController::$test);


        $form = $this->createForm(CommandeVenteType::class,$commande);


        return $this->render('@Vente/Produit/commande.html.twig',array("form" =>$form ->createView()));

    }

    public function ajoutcPAction(Request $request){

        $commande= new LigneCommande();
        $form = $this->createForm(LigneCommandeType::class,$commande);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($commande);
            $em->flush();
            return $this->redirectToRoute('listeC');
        }

        return ($this->render('@Vente/Default/ajoutC.html.twig',array("form"=> $form->createView())));
    }


    public function readAction()
    {
        $list=$this->getDoctrine()->getManager()
            ->getRepository(LigneCommande::class)->findAll();
        return ($this->render('@Vente/Default/listC.html.twig',array ("liste"=>$list)));}

    public function updateAction(Request $request, $id)
    {

        $em=$this->getDoctrine()->getManager();
        $i= $em->getRepository(LigneCommande::class)->find($id);




        $form= $this->createForm(LigneCommandeType::class,$i);






        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $ef= $this->getDoctrine()->getManager();
            $ef->persist($i);
            $ef->flush();

            return $this->redirectToRoute("listeC");



        }


        return $this->render("@Vente/Default/updateC.html.twig", array(
            'form'=>$form->createView(),"inv"=> $i));
    }

    public  function  removeAction($id){
        $em=$this->getDoctrine()->getManager();
        $i= $em->getRepository(LigneCommande::class)->find($id);
        $em->remove($i);
        $em->flush();
        return $this->redirectToRoute("listeC");

    }


    public function showAction()
    {
        $list=$this->getDoctrine()->getManager()->getRepository(CommandeVente::class)->findAll();
        $total=$this->getDoctrine()->getManager()->getRepository(CommandeVente::class)->findByTotal();
        return ($this->render('@Vente/Default/listCommande.html.twig',array ("liste"=>$list
        ,'total'=>$total)));}




        public function detailAction( $id){


        $commande=$this->getDoctrine()->getManager()->getRepository(CommandeVente::class)->find($id);

            return ($this->render('@Vente/Default/DetailsCommande.html.twig',array ("liste"=>$commande->getLignecommandes())));

        }


    public function PDFfAction(Request $request)
    {
        $snappy = $this->get('knp_snappy.pdf');
        $em=$this->getDoctrine()->getManager();


        $html = $this->renderView('@Vente/Default/pdf.html.twig'

        );

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
