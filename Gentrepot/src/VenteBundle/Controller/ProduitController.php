<?php

namespace VenteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;
use VenteBundle\Entity\Produit;
use VenteBundle\Entity\SousCategorie;

use VenteBundle\Form\ProduitType;

class ProduitController extends Controller
{

    public function ajoutPAction(Request $request){

        $produit= new Produit();
        $form = $this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()){

            $file = $form ['image']->getData();


            $newImageName = $file->getClientOriginalName();

            $file->move($this->getParameter('images_directory'), $newImageName);

            $produit->setImage($newImageName);
            $produit->setImage1($newImageName);
            $produit->setImage2($newImageName);
            $produit->setImage3($newImageName);
            $produit->setImage4($newImageName);


            dump($file);

            dump($produit);
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('list');
        }

        return ($this->render('@Vente/Produit/produit.html.twig',array("form"=> $form->createView())));
    }

    public function afficheAction()
    {
        $list=$this->getDoctrine()->getManager()
            ->getRepository(Produit::class)->findAll();
        return ($this->render('@Vente/Produit/affiche.html.twig',array ("list"=>$list)));}

    public function detailAction($reference)
    {
        $list=$this->getDoctrine()->getManager()
            ->getRepository(Produit::class)->find($reference);
        $last=$this->getDoctrine()->getManager()
            ->getRepository(Produit::class)->findAll();
        return ($this->render('@Vente/Produit/details.html.twig' ,array(
            'libelle' => $last,

        )));}



    public function listAction()
    {
        $list=$this->getDoctrine()->getManager()
            ->getRepository(Produit::class)->findAll();
        return ($this->render('@Vente/Produit/listP.html.twig',array ("produits"=>$list)));}


}
