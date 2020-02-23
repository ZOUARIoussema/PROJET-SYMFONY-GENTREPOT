<?php

namespace AchatBundle\Controller;

use AchatBundle\Entity\ProduitAchat;
use AchatBundle\Entity\SousCategorieAchat;
use AchatBundle\Form\ProduitAchatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProduitAchatController extends Controller
{


    /**
     * Lists all produit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('AchatBundle:ProduitAchat')->findAll();

        return $this->render('@Achat/produit/index.html.twig', array(
            'produits' => $produits,
        ));
    }

    /**
     * Creates a new produit entity.
     *
     */
    public function newAction(Request $request)
    {
        $produit = new ProduitAchat();
        $form = $this->createForm('AchatBundle\Form\ProduitAchatType', $produit);


        $form->add('sousCategorie', EntityType::class, ['class' => SousCategorieAchat::class, 'choice_label' => 'name', 'multiple' => false]);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {


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

            return $this->redirectToRoute('produit_show', array('reference' => $produit->getReference()));
        }

        return $this->render('@Achat/produit/new.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a produit entity.
     *
     */
    public function showAction(ProduitAchat $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);

        return $this->render('@Achat/produit/show.html.twig', array(
            'produit' => $produit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function detailAction(ProduitAchat $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);

        return $this->render('@Achat/produit/detail.html.twig', array(
            'produit' => $produit,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function prodsAction(SousCategorieAchat $cat)
    {
        $produits = $this->getDoctrine()->getManager()
            ->getRepository(ProduitAchat::class)->findBys($cat);
        return ($this->render('@Achat/souscategorie/prods.html.twig', array("list" => $produits,'souscategorie' => $cat,)));
    }
    /**
     * Displays a form to edit an existing produit entity.
     *
     */
    public function editAction(Request $request, ProduitAchat $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);
        $editForm = $this->createForm('AchatBundle\Form\ProduitAchatType', $produit);


        $editForm->add('sousCategorie',EntityType::class,['class'=>SousCategorieAchat::class,'choice_label'=>'name','multiple'=>false]);


        $editForm->handleRequest($request);


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produit_show', array('reference' => $produit->getReference()));
        }

        return $this->render('@Achat/produit/edit.html.twig', array(
            'produit' => $produit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produit entity.
     *
     */
    public function deleteAction(Request $request, ProduitAchat $produit)
    {
        $form = $this->createDeleteForm($produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produit);
            $em->flush();
        }

        return $this->redirectToRoute('produit_index');
    }

    public function listAction(EntityManagerInterface $em, PaginatorInterface $paginator, Request $request)
    {
        $dql   = "SELECT a FROM AcmeMainBundle:Article a";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        // parameters to template
        return $this->render('article/list.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Creates a form to delete a produit entity.
     *
     * @param ProduitAchat $produit The produit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProduitAchat $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produit_delete', array('reference' => $produit->getReference())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }


    //ajouter par image

    public function ajoutPAction(Request $request){

        $produit= new ProduitAchat();
        $form = $this->createForm(ProduitAchatType::class,$produit);
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








    public function ajoutParImageAction(Request $request){

        $produit= new ProduitAchat();
        $form = $this->createForm(ProduitAchatType::class,$produit);
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
            ->getRepository(ProduitAchat::class)->findAll();
        return ($this->render('@Achat/produit/affiche.html.twig',array ("list"=>$list)));}

    public function detailPAction($reference)
    {
        $list=$this->getDoctrine()->getManager()
            ->getRepository(Produit::class)->find($reference);
        $last=$this->getDoctrine()->getManager()
            ->getRepository(Produit::class)->findAll();
        return ($this->render('@Vente/Produit/details.html.twig' ,array(
            'libelle' => $last,

        )));}



    public function listPAction()
    {
        $list=$this->getDoctrine()->getManager()
            ->getRepository(Produit::class)->findAll();
        return ($this->render('@Vente/Produit/listP.html.twig',array ("produits"=>$list)));}

    
        
        

    public function shopAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('AchatBundle:CategorieAchat')->findAll();
        $list = $this->getDoctrine()->getManager()
            ->getRepository(ProduitAchat::class)->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $list,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );

        return $this->render('@Achat/produit/shop.html.twig', array('list' => $result,
            'categories'=>$categories));
    }

    public function shopTAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('AchatBundle:ProduitAchat')->findallProduitAchat();
        $list = $this->getDoctrine()->getManager()
            ->getRepository(ProduitAchat::class)->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $list,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );

        return $this->render('@Achat/produit/shop.html.twig', array('list' => $result,
            'categories'=>$categories));
    }

    public function shopTrAction()
    {
        $list = $this->getDoctrine()->getManager()
            ->getRepository(ProduitAchat::class)->findallProduitAchatD();
        return ($this->render('@Achat/produit/shop.html.twig', array("list" => $list)));
    }

    public function searchAction( Request $request){
        $em= $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $posts = $em->getRepository('AchatBundle:ProduitAchat')->findEntitiesByString($requestString);
        if(!$posts)
        {
            $result['posts']['error']="Post not found :(";
        }
        else {
            $result['posts']=$this->getRealEntities($posts);
        }
        return new Response(json_encode($result));
    }

    public function getRealEntities($posts){
        foreach ($posts as $posts){
            $realEntities[$posts->getId()] =[$posts->getImage(), $posts->getLibelle()];

        }
        return $realEntities;
    }


}
