<?php

namespace StockageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneCommandeDApprovisionnement
 *
 * @ORM\Table(name="ligne_commande_d_approvisionnement")
 * @ORM\Entity(repositoryClass="StockageBundle\Repository\LigneCommandeDApprovisionnementRepository")
 */
class LigneCommandeDApprovisionnement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;




    /**
     * @ORM\ManyToOne(targetEntity="CommandeDAprovisionnement",cascade={"persist"})
     * @ORM\JoinColumn(name="numeroC_commandeAp",referencedColumnName="numeroC")
     *
     */
    private $commande;



    /**
     * @ORM\ManyToOne(targetEntity="AchatBundle\Entity\ProduitAchat",cascade={"persist"})
     * @ORM\JoinColumn(name="ref_produit",referencedColumnName="reference")
     *
     */
    private $produit;


    /**
     * @ORM\Column(type="integer")
     */

    private $prix;

    /**
     * @ORM\Column(type="float")
     */

    private $quantite;


    /**
     * @ORM\Column(type="float")
     */

    private $total;



    /**
     * @ORM\Column(type="float")
     */
    private $tva;

    /**
     * @return mixed
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * @param mixed $commande
     */
    public function setCommande($commande)
    {
        $this->commande = $commande;
    }

    /**
     * @return mixed
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * @param mixed $produit
     */
    public function setProduit($produit)
    {
        $this->produit = $produit;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param mixed $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * @param mixed $tva
     */
    public function setTva($tva)
    {
        $this->tva = $tva;
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
}

