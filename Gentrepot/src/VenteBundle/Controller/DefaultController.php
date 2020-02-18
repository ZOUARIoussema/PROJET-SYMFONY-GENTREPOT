<?php

namespace VenteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VenteBundle:Default:index.html.twig');
    }
    public function readAction()
    {
        $list=$this->getDoctrine()->getManager()
            ->getRepository(User::class)->findAll();
        return ($this->render('@Vente/Default/list.html.twig',array ("liste"=>$list)));}

    public function adminAction()
    {
        $list=$this->getDoctrine()->getManager()
            ->getRepository(User::class)->findAll();
        return ($this->render('@Vente/Default/admin.html.twig',array ("list"=>$list)));}

    public function homeAction()
    {
        return $this->render('@Vente/Default/home.html.twig');
    }
}
