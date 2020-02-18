<?php

namespace TresorerieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventaireCaisse
 *
 * @ORM\Table(name="inventaire_caisse")
 * @ORM\Entity(repositoryClass="TresorerieBundle\Repository\InventaireCaisseRepository")
 */
class InventaireCaisse
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
     * @ORM\Column(type="date")
     */
    private $dateCreation;
    /**
     * @ORM\Column(type="float")
     */
    private $soldeCalculer;
    /**
     * @ORM\Column(type="float")
     */
    private $soldeTheorique;




    /**
     * @ORM\Column(type="float")
     */
    private $soldeCheque;

    /**
     * @ORM\Column(type="float")
     */
    private $soldeEspece;

    /**
     * @return mixed
     */
    public function getSoldeCheque()
    {
        return $this->soldeCheque;
    }

    /**
     * @param mixed $soldeCheque
     */
    public function setSoldeCheque($soldeCheque)
    {
        $this->soldeCheque = $soldeCheque;
    }

    /**
     * @return mixed
     */
    public function getSoldeEspece()
    {
        return $this->soldeEspece;
    }

    /**
     * @param mixed $soldeEspece
     */
    public function setSoldeEspece($soldeEspece)
    {
        $this->soldeEspece = $soldeEspece;
    }




    /**
     * @ORM\Column(type="float")
     */
    private $ecart;
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
    public function getSoldeCalculer()
    {
        return $this->soldeCalculer;
    }

    /**
     * @param mixed $soldeCalculer
     */
    public function setSoldeCalculer($soldeCalculer)
    {
        $this->soldeCalculer = $soldeCalculer;
    }

    /**
     * @return mixed
     */
    public function getSoldeTheorique()
    {
        return $this->soldeTheorique;
    }

    /**
     * @param mixed $soldeTheorique
     */
    public function setSoldeTheorique($soldeTheorique)
    {
        $this->soldeTheorique = $soldeTheorique;
    }

    /**
     * @return mixed
     */
    public function getEcart()
    {
        return $this->ecart;
    }

    /**
     * @param mixed $ecart
     */
    public function setEcart($ecart)
    {
        $this->ecart = $ecart;
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

