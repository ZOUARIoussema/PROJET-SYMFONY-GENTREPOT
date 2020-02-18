<?php

namespace logistiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ordremission
 *
 * @ORM\Table(name="ordremission")
 * @ORM\Entity(repositoryClass="logistiqueBundle\Repository\ordremissionRepository")
 */
class ordremission
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }




    /**
     * @ORM\ManyToOne(targetEntity="vehicule")
     * @ORM\JoinColumn(name="id_vehicule",referencedColumnName="id")
     */
    private $id_vehicule;

    /**
     * @return mixed
     */
    public function getIdVehicule()
    {
        return $this->id_vehicule;
    }

    /**
     * @param mixed $id_vehicule
     */
    public function setIdVehicule($id_vehicule)
    {
        $this->id_vehicule = $id_vehicule;
    }
    /**
     * @ORM\ManyToOne(targetEntity="chauffeur")
     * @ORM\JoinColumn(name="id_chauffeur",referencedColumnName="cin")
     */
    private $id_chauffeur;

    /**
     * @return mixed
     */
    public function getIdChauffeur()
    {
        return $this->id_chauffeur;
    }

    /**
     * @param mixed $id_chauffeur
     */
    public function setIdChauffeur($id_chauffeur)
    {
        $this->id_chauffeur = $id_chauffeur;
    }
    /**
     * @ORM\ManyToOne(targetEntity="aidechauffeur")
     * @ORM\JoinColumn(name="id_aidechauff",referencedColumnName="cin")
     */
    private $id_aidechauff;

    /**
     * @return mixed
     */
    public function getIdAidechauff()
    {
        return $this->id_aidechauff;
    }

    /**
     * @param mixed $id_aidechauff
     */
    public function setIdAidechauff($id_aidechauff)
    {
        $this->id_aidechauff = $id_aidechauff;
    }
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreation", type="date")
     */
    private $datecreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datesortie", type="date")
     */
    private $datesortie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateretour", type="date")
     */
    private $dateretour;




    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return ordremission
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * Set datesortie
     *
     * @param \DateTime $datesortie
     *
     * @return ordremission
     */
    public function setDatesortie($datesortie)
    {
        $this->datesortie = $datesortie;

        return $this;
    }

    /**
     * Get datesortie
     *
     * @return \DateTime
     */
    public function getDatesortie()
    {
        return $this->datesortie;
    }

    /**
     * Set dateretour
     *
     * @param \DateTime $dateretour
     *
     * @return ordremission
     */
    public function setDateretour($dateretour)
    {
        $this->dateretour = $dateretour;

        return $this;
    }

    /**
     * Get dateretour
     *
     * @return \DateTime
     */
    public function getDateretour()
    {
        return $this->dateretour;
    }
}
