<?php

namespace ApiBundle\Controller;

use AchatBundle\Entity\BonRetour;
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


class ApiBonRetourController extends Controller
{
    public function deletebonRetourAction($id){
        $produit = $this->getDoctrine()->getRepository(BonRetour::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($produit);
        $em->flush();
        return new Response("Done");


    }


    public function AddBonRetourAction(Request $request){

        $souscat = $this->getDoctrine()->getRepository(CommandeDAprovisionnement::class)->find($request->get('cap'));
        $b = $this->getDoctrine()->getRepository(BonRetour::class)->findOneBy(array('numeroC_commandeAp'=>$souscat));

        if(!$b) {
            $date = new \DateTime($request->get('date'));
            $bon = new BonRetour();
            $bon->setDate($date);
            $bon->setMotifDeRetour($request->get('motif'));
            $bon->setNumeroCCommandeAp($souscat);
            $em = $this->getDoctrine()->getManager();
            $em->persist($bon);
            $em->flush();
            return new Response("Done");
        }
        else{
            return new Response("error");
        }
    }


    public function ListeBonRetourAction(){
        $souscat = $this->getDoctrine()->getRepository(BonRetour::class)->findAll();
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
// Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);
        $formatted = $serializer->normalize(['bonretour' => $souscat]);
        return new JsonResponse($formatted);
    }

















}
