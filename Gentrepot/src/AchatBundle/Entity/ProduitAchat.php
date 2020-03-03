<?php

namespace AchatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ProduitAchat
 *
 * @ORM\Table(name="produit_achat")
 * @ORM\Entity(repositoryClass="AchatBundle\Repository\ProduitAchatRepository")
 */
class ProduitAchat
{
    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string")
     * @ORM\Id

     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity="SousCategorieAchat")
     * @ORM\JoinColumn(name="sousCategorie_id",referencedColumnName="id")
     */
    private $sousCategorie;

    /**
     * @return mixed
     */
    public function getSousCategorie()
    {
        return $this->sousCategorie;
    }

    /**
     * @param mixed $sousCategorie
     */
    public function setSousCategorie($sousCategorie)
    {
        $this->sousCategorie = $sousCategorie;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;



    /**
     * @var int
     *
     * @ORM\Column(name="quantiteEnStock", type="integer")
     */
    private $quantiteEnStock;

    /**
     * @var string
     *
     * @ORM\Column(name="classe", type="string", length=255)
     */
    private $classe;

    /**
     * @var int
     *
     * @ORM\Column(name="quantiteStockSecurite", type="integer")
     */
    private $quantiteStockSecurite;

    /**
     * @var float
     *
     * @ORM\Column(name="dernierPrixAchat", type="float")
     */
    private $dernierPrixAchat;

    /**
     * @var float
     *
     * @ORM\Column(name="TVA", type="float")
     */
    private $tVA;

    /**
     * @var float
     *
     * @ORM\Column(name="dimension", type="float")
     */
    private $dimension;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="typeDeConditionnement", type="string", length=255)
     */
    private $typeDeConditionnement;

    /**
     * @var float
     *
     * @ORM\Column(name="prixVente", type="float")
     */
    private $prixVente;

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Produit
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @return int
     */
    public function getQuantiteEnStock()
    {
        return $this->quantiteEnStock;
    }

    /**
     * @param int $quantiteEnStock
     */
    public function setQuantiteEnStock($quantiteEnStock)
    {
        $this->quantiteEnStock = $quantiteEnStock;
    }



    /**
     * Set classe
     *
     * @param string $classe
     *
     * @return Produit
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return string
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @return int
     */
    public function getQuantiteStockSecurite()
    {
        return $this->quantiteStockSecurite;
    }

    /**
     * @param int $quantiteStockSecurite
     */
    public function setQuantiteStockSecurite($quantiteStockSecurite)
    {
        $this->quantiteStockSecurite = $quantiteStockSecurite;
    }



    /**
     * Set dernierPrixAchat
     *
     * @param float $dernierPrixAchat
     *
     * @return Produit
     */
    public function setDernierPrixAchat($dernierPrixAchat)
    {
        $this->dernierPrixAchat = $dernierPrixAchat;

        return $this;
    }

    /**
     * Get dernierPrixAchat
     *
     * @return float
     */
    public function getDernierPrixAchat()
    {
        return $this->dernierPrixAchat;
    }

    /**
     * Set tVA
     *
     * @param float $tVA
     *
     * @return Produit
     */
    public function setTVA($tVA)
    {
        $this->tVA = $tVA;

        return $this;
    }

    /**
     * Get tVA
     *
     * @return float
     */
    public function getTVA()
    {
        return $this->tVA;
    }

    /**
     * @return float
     */
    public function getDimension()
    {
        return $this->dimension;
    }

    /**
     * @param float $dimension
     */
    public function setDimension($dimension)
    {
        $this->dimension = $dimension;
    }





    /**
     * Set description
     *
     * @param string $description
     *
     * @return Produit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set typeDeConditionnement
     *
     * @param string $typeDeConditionnement
     *
     * @return Produit
     */
    public function setTypeDeConditionnement($typeDeConditionnement)
    {
        $this->typeDeConditionnement = $typeDeConditionnement;

        return $this;
    }

    /**
     * Get typeDeConditionnement
     *
     * @return string
     */
    public function getTypeDeConditionnement()
    {
        return $this->typeDeConditionnement;
    }

    /**
     * Set prixVente
     *
     * @param float $prixVente
     *
     * @return Produit
     */
    public function setPrixVente($prixVente)
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    /**
     * Get prixVente
     *
     * @return float
     */
    public function getPrixVente()
    {
        return $this->prixVente;
    }



    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please Upload Image")
     */
    private $image;

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please Upload Image")
     */
    private $image1;

    /**
     * @return mixed
     */
    public function getImage1()
    {
        return $this->image1;
    }

    /**
     * @param mixed $image1
     */
    public function setImage1($image1)
    {
        $this->image1 = $image1;
    }

    /**
     * @return mixed
     */
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * @param mixed $image2
     */
    public function setImage2($image2)
    {
        $this->image2 = $image2;
    }

    /**
     * @return mixed
     */
    public function getImage3()
    {
        return $this->image3;
    }

    /**
     * @param mixed $image3
     */
    public function setImage3($image3)
    {
        $this->image3 = $image3;
    }

    /**
     * @return mixed
     */
    public function getImage4()
    {
        return $this->image4;
    }

    /**
     * @param mixed $image4
     */
    public function setImage4($image4)
    {
        $this->image4 = $image4;
    }

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please Upload Image")
     */
    private $image2;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please Upload Image")
     */
    private $image3;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please Upload Image")
     */
    private $image4;

}

