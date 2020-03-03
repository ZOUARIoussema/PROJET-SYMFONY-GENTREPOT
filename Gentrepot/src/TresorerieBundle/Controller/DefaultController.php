<?php

namespace TresorerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use TresorerieBundle\Entity\FactureAchat;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $list=$this->getDoctrine()->getRepository(FactureAchat::class)->findByDateEchaillancePaiement(new \DateTime());



        /*  $r= $this->getDoctrine()->getEntityManager()
              ->createQuery("select n.id from
                               MgiletNotificationBundle:Notification n
                               where n.message ='facture'
                              ");

          $id=$r->getResult();



        $r= $this->getDoctrine()->getEntityManager()
              ->createQuery("delete from
                               MgiletNotificationBundle:NotifiableNotification  n
                               where n.notifiacation=?1
                              ")->setParametre(array(1=>$id))
                               ->execute();


          $r= $this->getDoctrine()->getEntityManager()
              ->createQuery("delete from
                               MgiletNotificationBundle:NotifiableEntity
                              ")->execute();


          $r= $this->getDoctrine()->getEntityManager()
              ->createQuery("delete from
                               MgiletNotificationBundle:Notification
                              ")->execute();*/




        $manager = $this->get('mgilet.notification');
        $notif = $manager->createNotification('Facture Fournisseur impayer');



        foreach ($list as $f )
        {


            $notif->setMessage('numero facture'.$f->getNumeroF());


            $manager->addNotification(array($this->getUser()), $notif, true);


        }







        return $this->render('@Tresorerie/Default/index.html.twig');
    }
}
