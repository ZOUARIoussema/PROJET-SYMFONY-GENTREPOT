<?php

namespace AchatBundle\Controller;

use AchatBundle\Entity\ProduitAchat;
use AchatBundle\Entity\SousCategorieAchat;
use AchatBundle\Form\ProduitAchatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ProduitAchatController extends Controller
{


    /**
     * Lists all produit entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('AchatBundle:ProduitAchat')->findAll();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $produits,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3));

        return $this->render('@Achat/produit/index.html.twig', array(
            'produits' => $result,
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

            $file = $form ['image1']->getData();
            $newImageName1 = $file->getClientOriginalName();

            $file = $form ['image2']->getData();
            $newImageName2 = $file->getClientOriginalName();

            $file = $form ['image3']->getData();
            $newImageName3 = $file->getClientOriginalName();

            $file = $form ['image4']->getData();
            $newImageName4 = $file->getClientOriginalName();

            $file->move($this->getParameter('images_directory'), $newImageName);

            $produit->setImage($newImageName);
            $produit->setImage1($newImageName1);
            $produit->setImage2($newImageName2);
            $produit->setImage3($newImageName3);
            $produit->setImage4($newImageName4);


            //  dump($file);
            // dump($produit);
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

    public function likeAction(Request $request,  $reference)
    {
        $dql = 'SELECT p FROM AchatBundle:ProduitAchat p   WHERE p.reference = :r';
        $em=$this->getDoctrine()->getManager();
        $query = $em->createQuery( $dql )->setParameter('r', $reference);
        $product = $query->setMaxResults(1)->getOneOrNullResult();
        //  $product->addLike();
        $em->flush($product);

        $deleteForm = $this->createDeleteForm($product);
        return $this->render('@Achat/produit/show.html.twig', array(
            'produit' => $product,
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



            $file = $editForm ['image']->getData();
            $newImageName = $file->getClientOriginalName();

            $file = $editForm ['image1']->getData();
            $newImageName1 = $file->getClientOriginalName();

            $file = $editForm ['image2']->getData();
            $newImageName2 = $file->getClientOriginalName();

            $file = $editForm ['image3']->getData();
            $newImageName3 = $file->getClientOriginalName();

            $file = $editForm ['image4']->getData();
            $newImageName4 = $file->getClientOriginalName();

            $file->move($this->getParameter('images_directory'), $newImageName);

            $produit->setImage($newImageName);
            $produit->setImage1($newImageName1);
            $produit->setImage2($newImageName2);
            $produit->setImage3($newImageName3);
            $produit->setImage4($newImageName4);


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


    public function afficheAction( Request $request ,  PaginatorInterface  $paginator)
    {
        $em =  $this->getDoctrine()->getManager();
        $dql = "SELECT p from AchatBundle:ProduitAchat p";
        $query = $em->createQuery($dql);

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),10  );

        return ($this->render('@Achat/produit/affiche.html.twig',array ("list"=>$pagination)));

    }




    public function detailPAction($reference)
    {
        $list=$this->getDoctrine()->getManager()
            ->getRepository(Produit::class)->find($reference);
        $last=$this->getDoctrine()->getManager()
            ->getRepository(Produit::class)->findAll();
        return ($this->render('@Vente/Produit/details.html.twig' ,array(
            'libelle' => $last,

        )));}

    public function shopAction(Request $request)
    {
        $em =  $this->getDoctrine()->getManager();

        $filter = $request->get('filter');
        $categories = $request->get('categories');

        if (!empty($categories)) {
            $dql = "select c from  AchatBundle:SousCategorieAchat c where  c.name like :q ";
            $query = $em->createQuery($dql)->setParameter("q", "%".$categories."%")->getResult();
        }

        if (!empty($filter)) {
            $dql = "select p from  AchatBundle:ProduitAchat p where
                    p.libelle like :q or 
                    p.reference like :q or 
                     p.description like :q ";
            $query = $em->createQuery($dql)->setParameter("q", "%".$filter."%")->getResult();
        }else{
            $dql = "SELECT p from AchatBundle:ProduitAchat p";
            $query = $em->createQuery($dql);
        }

        $sousCategories = $em->getRepository('AchatBundle:SousCategorieAchat')->findAll();



        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        if ($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('AchatBundle:produit:_product_content.html.twig', ['list' => $pagination]),
                'pagination' => $this->renderView('AchatBundle:produit:_product_pagination.html.twig', ['list' => $pagination]),

            ]);
        }


        return ($this->render('@Achat/produit/shop.html.twig',array (
            "list"=>$pagination,
            "categories"=>$sousCategories,

        )));}

    public function shopTAction()
    {
        $list = $this->getDoctrine()->getManager()
            ->getRepository(ProduitAchat::class)->findallProduitAchat();
        return ($this->render('@Achat/produit/shop.html.twig', array("list" => $list)));
    }

    public function shopTrAction()
    {
        $list = $this->getDoctrine()->getManager()
            ->getRepository(ProduitAchat::class)->findallProduitAchatD();
        return ($this->render('@Achat/produit/shop.html.twig', array("list" => $list)));
    }



}
