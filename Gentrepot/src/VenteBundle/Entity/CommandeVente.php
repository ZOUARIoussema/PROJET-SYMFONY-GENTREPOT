<?php

namespace VenteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use VenteBundle\Entity\LigneCommande;

/**
 * CommandeVente
 *
 * @ORM\Table(name="commande_vente")
 * @ORM\Entity(repositoryClass="VenteBundle\Repository\CommandeVenteRepository")
 */
class CommandeVente
{
    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;



    /**
     * @ORM\Column(name="totalC", type="float",nullable=true)
     */

    private  $totalC;


    /**
     * @ORM\Column(name="dateC", type="date",nullable=true)
     */
    private $dateC;

    /**
     * @ORM\Column(name="etat", type="string",nullable=true)
     */

    private $etat;

    /**
     * @ORM\Column(name="tauxRemise", type="float",nullable=true)
     */

    private $tauxRemise;

    /**
     * CommandeVente constructor.
     * @param $lignecommandes
     */
    public function __construct()
    {
        $this->lignecommandes = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getTotalC()
    {
        return $this->totalC;
    }

    /**
     * @param mixed $totalC
     */
    public function setTotalC($totalC)
    {
        $this->totalC = $totalC;
    }

    /**
     * @return mixed
     */
    public function getDateC()
    {
        return $this->dateC;
    }

    /**
     * @param mixed $dateC
     */
    public function setDateC($dateC)
    {
        $this->dateC = $dateC;
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
    public function getTauxRemise()
    {
        return $this->tauxRemise;
    }

    /**
     * @param mixed $tauxRemise
     */
    public function setTauxRemise($tauxRemise)
    {
        $this->tauxRemise = $tauxRemise;
    }


    public function __toString()
    {
        return(string) $this->id ;   }

    /**
     * @ORM\Column(name="lignecommande", type="array",nullable=true)
     */
    private  $lignecommandes;

    /**
     * @return mixed
     */
    public function getLignecommandes()
    {
        return $this->lignecommandes;
    }

    /**
     * @param mixed $lignecommandes
     */
    public function setLignecommandes($lignecommandes)
    {
        $this->lignecommandes = $lignecommandes;
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
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }





    /**
     * @ORM\Column(type="string",nullable=true)
     */
    private $user;




}
