<?php

namespace ApiBundle\Controller;

use AchatBundle\Entity\BonEntree;
use Doctrine\Common\Collections\ArrayCollection;
use StockageBundle\Entity\CommandeDAprovisionnement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use TresorerieBundle\Entity\LettreDeRelance;
use UserBundle\Entity\User;


class ApiBonEntreeController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bonEntrees = $em->getRepository('AchatBundle:BonEntree')->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($bonEntrees);
        return new JsonResponse($formatted);

    }

    public function deletebonentreeAction($id){
        $produit = $this->getDoctrine()->getRepository(BonEntree::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($produit);
        $em->flush();
        return new Response("Done");


    }


    public function AddBonentreeAction(Request $request){
        $bonentree = new BonEntree();
        $souscat = $this->getDoctrine()->getRepository(CommandeDAprovisionnement::class)->find($request->get('cap'));
        $b = $this->getDoctrine()->getRepository(BonEntree::class)->findOneBy(array('numeroC_commandeAp'=>$souscat));
        if(!$b) {
            $bonentree->setNumeroCCommandeAp($souscat);
            $date = new \DateTime($request->get('date'));
            $dateprod = new \DateTime($request->get('dateProd'));
            $dateexp = new \DateTime($request->get('dateExp'));
            $bonentree->setDate($date);
            $bonentree->setDateProduction($dateprod);
            $bonentree->setDateExpiration($dateexp);
            $em = $this->getDoctrine()->getManager();
            $em->persist($bonentree);
            $em->flush();
            return new Response("Done");
        }
        else{
            return new Response("error");
        }
    }

    public function ListeBonEntreeAction(){
        $souscat = $this->getDoctrine()->getRepository(BonEntree::class)->findAll();
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
// Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $formatted = $serializer->normalize(['bonEntree' => $souscat]);
        return new JsonResponse($formatted);
    }

}
