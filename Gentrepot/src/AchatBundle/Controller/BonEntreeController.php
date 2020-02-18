<?php

namespace AchatBundle\Controller;

use AchatBundle\Entity\BonEntree;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BonEntreeController extends Controller
{

    /**
     * Lists all bonEntree entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bonEntrees = $em->getRepository('AchatBundle:BonEntree')->findAll();

        return $this->render('@Achat/bonentree/index.html.twig', array(
            'bonEntrees' => $bonEntrees,
        ));
    }

    /**
     * Creates a new bonEntree entity.
     *
     */
    public function newAction(Request $request)
    {
        $bonEntree = new Bonentree();
        $form = $this->createForm('AchatBundle\Form\BonEntreeType', $bonEntree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bonEntree);
            $em->flush();

            return $this->redirectToRoute('bonentree_show', array('id' => $bonEntree->getId()));
        }

        return $this->render('@Achat/bonentree/new.html.twig', array(
            'bonEntree' => $bonEntree,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bonEntree entity.
     *
     */
    public function showAction(BonEntree $bonEntree)
    {
        $deleteForm = $this->createDeleteForm($bonEntree);

        return $this->render('@Achat/bonentree/show.html.twig', array(
            'bonEntree' => $bonEntree,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing bonEntree entity.
     *
     */
    public function editAction(Request $request, BonEntree $bonEntree)
    {
        $deleteForm = $this->createDeleteForm($bonEntree);
        $editForm = $this->createForm('AchatBundle\Form\BonEntreeType', $bonEntree);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bonentree_edit', array('id' => $bonEntree->getId()));
        }

        return $this->render('@Achat/bonentree/edit.html.twig', array(
            'bonEntree' => $bonEntree,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bonEntree entity.
     *
     */
    public function deleteAction(Request $request, BonEntree $bonEntree)
    {
        $form = $this->createDeleteForm($bonEntree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bonEntree);
            $em->flush();
        }

        return $this->redirectToRoute('bonentree_index');
    }

    /**
     * Creates a form to delete a bonEntree entity.
     *
     * @param BonEntree $bonEntree The bonEntree entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BonEntree $bonEntree)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bonentree_delete', array('id' => $bonEntree->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }


}
