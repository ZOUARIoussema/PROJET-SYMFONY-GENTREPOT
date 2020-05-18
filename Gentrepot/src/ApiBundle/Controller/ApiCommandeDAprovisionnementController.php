<?php


namespace ApiBundle\Controller;


use Proxies\__CG__\VenteBundle\Entity\FactureVente;
use StockageBundle\Entity\LigneCommandeDApprovisionnement;
use StockageBundle\Form\CommandeDAprovisionnementType;
use StockageBundle\Form\LigneCommandeDApprovisionnementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use StockageBundle\Entity\CommandeDAprovisionnement;


class ApiCommandeDAprovisionnementController extends Controller
{

    public function allAction()
    {
        $com = $this->getDoctrine()->getManager()
            ->getRepository(CommandeDAprovisionnement::class)
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($com);
        return new JsonResponse($formatted);
    }


    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $commande = new CommandeDAprovisionnement();
        $commande->setDateCreation(new \DateTime());
        $commande->setEtat("non_facturer");
        $commande->setTotalTVA($request->get('totalTva'));
        $commande->setTotalC($request->get('totalC'));
        $commande->setTauxRemise($request->get('tauxRemise'));

        $commande->setFournisseur($this->getDoctrine()->getRepository(\AchatBundle\Entity\Fournisseur::class)->find($request->get('id')));

        $em->persist($commande);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($commande);
        return new JsonResponse($formatted);

    }

    public function deleteAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $commande=$em ->getRepository(CommandeDAprovisionnement::class)->find((int)$request->get('numeroC'));

        $em->remove($commande);
        $em->flush();



    }
}
