<?php

namespace MessageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MessageController extends Controller
{

    public function indexAction()
    {
        return $this->render('@Message/Message/layout.html.twig');
    }

    public function sentAction()
    {
        return $this->render('@Message/Message/sent.html.twig');
    }
}
