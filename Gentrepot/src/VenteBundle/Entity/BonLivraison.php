<?php

namespace VenteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BonLivraison
 *
 * @ORM\Table(name="bon_livraison")
 * @ORM\Entity(repositoryClass="VenteBundle\Repository\BonLivraisonRepository")
 */
class BonLivraison
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;


    /**
     * @ORM\Column(name="adresseLivraison", type="string")
     */
    private $adresseLivraison;



    /**
     * @ORM\Column(name="etat", type="string")
     */
    private $etat;
    /**
     * @ORM\ManyToOne(targetEntity="logistiqueBundle\Entity\ordremission")
     * @ORM\JoinColumn(name="id_ordremission",referencedColumnName="id")
     */

    private $id_ordemission;

    /**
     * @return mixed
     */
    public function getIdOrdemission()
    {
        return $this->id_ordemission;
    }



    /**
     * @ORM\Column(name="dateCreation", type="date")
     */
    private $dateCreation;

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param mixed $id_ordemission
     */
    public function setIdOrdemission($id_ordemission)
    {
        $this->id_ordemission = $id_ordemission;
    }

    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }



    /**
     * @return mixed
     */
    public function getAdresseLivraison()
    {
        return $this->adresseLivraison;
    }

    /**
     * @param mixed $adresseLivraison
     */
    public function setAdresseLivraison($adresseLivraison)
    {
        $this->adresseLivraison = $adresseLivraison;
    }


    /**
     * @ORM\Column(name="datesortie", type="date")
     */
    private $datesortie;

    /**
     * @return mixed
     */
    public function getDatesortie()
    {
        return $this->datesortie;
    }





    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     *
     * @ORM\OneToOne(targetEntity="CommandeVente")
     * @ORM\JoinColumn(name="idC_Commande",referencedColumnName="id")
     */
    private $BonLivraison;

    /**
     * @return mixed
     */
    public function getBonLivraison()
    {
        return $this->BonLivraison;
    }

    /**
     * @param mixed $BonLivraison
     */
    public function setBonLivraison($BonLivraison)
    {
        $this->BonLivraison = $BonLivraison;
    }
}

