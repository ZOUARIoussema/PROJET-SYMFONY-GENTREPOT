<?php

namespace TresorerieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\MappedSuperclass()
 *
 */
class ReglementFournisseur
{
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotNull(message="le valeur d'ecart doit etre non null ")
     */
    private  $montant;




    /**
     * @ORM\Column(type="date")
     */
    private  $dateCreation;

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
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param mixed $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
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

