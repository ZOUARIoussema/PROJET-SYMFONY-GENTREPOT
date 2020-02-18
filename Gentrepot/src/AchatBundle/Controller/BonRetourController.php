<?php

namespace AchatBundle\Controller;

use AchatBundle\Entity\BonRetour;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BonRetourController extends Controller
{

    /**
     * Lists all bonRetour entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bonRetours = $em->getRepository('AchatBundle:BonRetour')->findAll();

        return $this->render('@Achat/bonretour/index.html.twig', array(
            'bonRetours' => $bonRetours,
        ));
    }

    /**
     * Creates a new bonRetour entity.
     *
     */
    public function newAction(Request $request)
    {
        $bonRetour = new BonRetour();
        $form = $this->createForm('AchatBundle\Form\BonRetourType', $bonRetour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bonRetour);
            $em->flush();

            return $this->redirectToRoute('bonretour_show', array('id' => $bonRetour->getId()));
        }

        return $this->render('@Achat/bonretour/new.html.twig', array(
            'bonRetour' => $bonRetour,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a bonRetour entity.
     *
     */
    public function showAction(BonRetour $bonRetour)
    {
        $deleteForm = $this->createDeleteForm($bonRetour);

        return $this->render('@Achat/bonretour/show.html.twig', array(
            'bonRetour' => $bonRetour,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing bonRetour entity.
     *
     */
    public function editAction(Request $request, BonRetour $bonRetour)
    {
        $deleteForm = $this->createDeleteForm($bonRetour);
        $editForm = $this->createForm('AchatBundle\Form\BonRetourType', $bonRetour);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bonretour_edit', array('id' => $bonRetour->getId()));
        }

        return $this->render('@Achat/bonretour/edit.html.twig', array(
            'bonRetour' => $bonRetour,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a bonRetour entity.
     *
     */
    public function deleteAction(Request $request, BonRetour $bonRetour)
    {
        $form = $this->createDeleteForm($bonRetour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bonRetour);
            $em->flush();
        }

        return $this->redirectToRoute('bonretour_index');
    }

    /**
     * Creates a form to delete a bonRetour entity.
     *
     * @param BonRetour $bonRetour The bonRetour entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BonRetour $bonRetour)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bonretour_delete', array('id' => $bonRetour->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
