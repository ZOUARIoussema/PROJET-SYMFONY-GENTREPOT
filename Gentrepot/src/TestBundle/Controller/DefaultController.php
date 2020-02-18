<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

}
