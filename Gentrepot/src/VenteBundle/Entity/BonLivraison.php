<?php

namespace VenteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(name="adresseLivraison", type="string",nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 4,
     *      max = 30,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters")
     */

    private $adresseLivraison;



    /**
     * @ORM\Column(name="etat", type="string",nullable=true)
     */
    private $etat;
    /**
     * @ORM\ManyToOne(targetEntity="logistiqueBundle\Entity\ordremission")
     * @ORM\JoinColumn(name="id_ordremission",referencedColumnName="id",nullable=true)
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
     * @ORM\Column(name="dateCreation", type="date",nullable=true)
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
     * @ORM\Column(name="datesortie", type="date",nullable=true)
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
     * @param mixed $datesortie
     */
    public function setDatesortie($datesortie)
    {
        $this->datesortie = $datesortie;
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
     * @ORM\JoinColumn(name="idC_Commande",referencedColumnName="id",nullable=true)
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

    /**
     * @ORM\Column(name="nom", type="string",nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(name="prenom", type="string",nullable=true)
     */
    private $prenom;

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }



}