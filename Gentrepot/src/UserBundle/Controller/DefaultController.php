<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

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

            return $this->render('@Test/backend/table.html.twig', array(
                'user' => $user,


            ));
        }
        if ($authChecker->isGranted('ROLE_RVENT')) {

            return $this->render('@Vente/Default/list.html.twig', array(
                'user' => $user,


            ));
        }


        if ($authChecker->isGranted('ROLE_CLIEN')) {

            return $this->render('@Vente/Produit/affiche.html.twig', array(
                'user' => $user,


            ));
        }


        if ($authChecker->isGranted('ROLE_ADMIN')) {

            return $this->render('@User/Default/index.html.twig', array(
                'user' => $user,


            ));
        }
        return $this->render('@Test/backend/ahmed.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,]);

    }



    public function readAction()
    {
        $list=$this->getDoctrine()->getManager()
            ->getRepository(User::class)->findAll();
        return ($this->render('@User/Default/list.html.twig',array ("list"=>$list)));}



}
