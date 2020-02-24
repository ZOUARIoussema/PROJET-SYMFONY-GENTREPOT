<?php

namespace AchatBundle\Controller;

use AchatBundle\Entity\CategorieAchat;
use AchatBundle\Entity\SousCategorieAchat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use VenteBundle\Entity\SousCategorie;

class SousCategorieAchatController extends Controller
{


    /**
     * Lists all sousCategorie entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sousCategories = $em->getRepository('AchatBundle:SousCategorieAchat')->findAll();

        return $this->render('@Achat/souscategorie/index.html.twig', array(
            'sousCategories' => $sousCategories,
        ));
    }

    public function indAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sousCategories = $em->getRepository('AchatBundle:SousCategorieAchat')->findAll();

        return $this->render('@Achat/ProduitAchat/shop.html.twig', array(
            'sousCategories' => $sousCategories,
        ));
    }

    /**
     * Creates a new sousCategorie entity.
     *
     */
    public function newAction(Request $request)
    {
        $sousCategorie = new SousCategorieAchat();
        $form = $this->createForm('AchatBundle\Form\SousCategorieAchatType', $sousCategorie);


        $form->add('categorie',EntityType::class,['class'=>CategorieAchat::class,'choice_label'=>'nom','multiple'=>false]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sousCategorie);
            $em->flush();

            return $this->redirectToRoute('souscategorie_show', array('id' => $sousCategorie->getId()));
        }

        return $this->render('@Achat/souscategorie/new.html.twig', array(
            'sousCategorie' => $sousCategorie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sousCategorie entity.
     *
     */
    public function showAction(SousCategorieAchat $sousCategorie)
    {
        $deleteForm = $this->createDeleteForm($sousCategorie);

        return $this->render('@Achat/souscategorie/show.html.twig', array(
            'sousCategorie' => $sousCategorie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sousCategorie entity.
     *
     */
    public function editAction(Request $request, SousCategorieAchat $sousCategorie)
    {
        $deleteForm = $this->createDeleteForm($sousCategorie);
        $editForm = $this->createForm('AchatBundle\Form\SousCategorieAchatType', $sousCategorie);


        $editForm->add('categorie',EntityType::class,['class'=>CategorieAchat::class,'choice_label'=>'id','multiple'=>false]);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('souscategorie_edit', array('id' => $sousCategorie->getId()));
        }

        return $this->render('@Achat/souscategorie/edit.html.twig', array(
            'sousCategorie' => $sousCategorie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sousCategorie entity.
     *
     */
    public function deleteAction(Request $request, SousCategorieAchat $sousCategorie)
    {
        $form = $this->createDeleteForm($sousCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sousCategorie);
            $em->flush();
        }

        return $this->redirectToRoute('souscategorie_index');
    }

    /**
     * Creates a form to delete a sousCategorie entity.
     *
     * @param SousCategorieAchat $sousCategorie The sousCategorie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SousCategorieAchat $sousCategorie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('souscategorie_delete', array('id' => $sousCategorie->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function prodsAction(CategorieAchat $cat)
    {
        $sousCategories = $this->getDoctrine()->getManager()
            ->getRepository(SousCategorieAchat::class)->findBys($cat);
        return ($this->render('@Achat/produit/shop.html.twig', array("sousCategories" => $sousCategories,'categorie' => $cat,)));
    }

}
