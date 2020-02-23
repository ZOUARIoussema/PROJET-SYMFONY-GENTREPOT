<?php

namespace StockageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LignePerte
 *
 * @ORM\Table(name="ligne_perte")
 * @ORM\Entity(repositoryClass="StockageBundle\Repository\LignePerteRepository")
 */
class LignePerte
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
     * @ORM\ManyToOne(targetEntity="Perte")
     * @ORM\JoinColumn(name="id_perte",referencedColumnName="id")
     *
     */


    private $perte;




    /**
     * @ORM\ManyToOne(targetEntity="AchatBundle\Entity\ProduitAchat")
     * @ORM\JoinColumn(name="ref_produit",referencedColumnName="reference")
     *
     */

    private $produit;

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
    public function getPerte()
    {
        return $this->perte;
    }

    /**
     * @param mixed $perte
     */
    public function setPerte($perte)
    {
        $this->perte = $perte;
    }


    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @var string
     *
     * @ORM\Column(name="raisonPerte", type="string", length=255)
     */
    private $raisonPerte;


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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return LignePerte
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set raisonPerte
     *
     * @param string $raisonPerte
     *
     * @return LignePerte
     */
    public function setRaisonPerte($raisonPerte)
    {
        $this->raisonPerte = $raisonPerte;

        return $this;
    }

    /**
     * Get raisonPerte
     *
     * @return string
     */
    public function getRaisonPerte()
    {
        return $this->raisonPerte;
    }
}

