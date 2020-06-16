<?php


namespace ApiBundle\Controller;


use StockageBundle\Entity\LigneCommandeDApprovisionnement;
use StockageBundle\Form\CommandeDAprovisionnementType;
use StockageBundle\Form\LigneCommandeDApprovisionnementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use StockageBundle\Entity\CommandeDAprovisionnement;

class ApiLigneCommandeDApprovisionnementController extends Controller
{
    public function allAction()
    {
        $lcoms = $this->getDoctrine()->getManager()
            ->getRepository(LigneCommandeDApprovisionnement::class)
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($lcoms);
        return new JsonResponse($formatted);
    }

    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $lcommande = new LigneCommandeDApprovisionnement();
        $lcommande->setQuantite($request->get('qte'));
        $lcommande->setTva($request->get('tva'));
        $lcommande->setPrix($request->get('prix'));
        $lcommande->setTotal($request->get('total'));
        $lcommande->setCommande($this->getDoctrine()->getRepository(\AchatBundle\Entity\CommandeDAprovisionnement::class)->find($request->get('numeroC')));
        $lcommande->setProduit($this->getDoctrine()->getRepository(\AchatBundle\Entity\ProduitAchat::class)->find($request->get('refPro')));

        $em->persist($lcommande);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($lcommande);
        return new JsonResponse($formatted);

    }

    public function deleteAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $lcommande=$em ->getRepository(LigneCommandeDApprovisionnement::class)->find((int)$request->get('id'));

        $em->remove($lcommande);
        $em->flush();



    }


}