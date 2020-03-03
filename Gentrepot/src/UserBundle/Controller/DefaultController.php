<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use VenteBundle\Entity\Produit;

class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->render('backend/index.html.twig');
    }


    public function testAction()
    {

        return $this->render('@Test/backend/table.html.twig');
    }



    public function frontAction()
    {

        return $this->render('frontend/index.html.twig');
    }

    public function test2Action()
    {

        return $this->render('@Test/frontend/cart.html.twig');
    }
    public function userAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $authChecker = $this->container->get('security.authorization_checker');
        $router = $this->container->get('router');
        if ($authChecker->isGranted('ROLE_SUPER_ADMIN')) {
//            return $this->render('events/showall.html.twig', array(
//                'events' => $events,
            return $this->render('@Test/backend/ahmed.html.twig', array(
                'user' => $user,


            ));
        }


        if ($authChecker->isGranted('ROLE_STOCK')) {

            return $this->render('@Stockage/Default/index.html.twig', array(
                'user' => $user,


            ));
        }
        if ($authChecker->isGranted('ROLE_RVENT')) {
            $list=$this->getDoctrine()->getManager()
                ->getRepository(User::class)->findAll();
            return $this->render('@Vente/Default/list.html.twig', array(
                'user' => $user,
                'liste'=>$list,


            ));
        }


        if ($authChecker->isGranted('ROLE_RACHA')) {

            return $this->render('@Achat/Default/index.html.twig', array(
                'user' => $user,


            ));
        }
        if ($authChecker->isGranted('ROLE_CPARC')) {

            return $this->render('@logistique/Default/index.html.twig', array(
                'user' => $user,


            ));
        }



        if ($authChecker->isGranted('ROLE_ACAIS')) {

            return $this->render('@Tresorerie/Default/index.html.twig', array(
                'user' => $user,


            ));
        }
        $list=$this->getDoctrine()->getManager()
            ->getRepository(Produit::class)->findAll();
        return $this->render('@Vente/produit/affiche.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'list'=>$list,
            ]);

    }



    public function readAction()
    {
        $list=$this->getDoctrine()->getManager()
            ->getRepository(User::class)->findAll();
        return ($this->render('@User/Default/list.html.twig',array ("list"=>$list)));}



}
