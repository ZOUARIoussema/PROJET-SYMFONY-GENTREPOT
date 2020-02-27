<?php

namespace logistiqueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * chauffeur
 *
 * @ORM\Table(name="chauffeur")
 * @ORM\Entity(repositoryClass="logistiqueBundle\Repository\chauffeurRepository")
 */
class chauffeur
{
    /**
     * @var string
     *
     * @ORM\Column(name="cin", type="string")
     * @ORM\Id
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;




    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return chauffeur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return chauffeur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return chauffeur
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return string
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * @return mixed
     */
    public function getVoyage()
    {
        return $this->voyage;
    }

    /**
     * @param mixed $voyage
     */
    public function setVoyage($voyage)
    {
        $this->voyage = $voyage;
    }

    /**
     * @ORM\Column(name="voyage",type="integer",options={"default":0})
     */
    private $voyage;

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
     * @ORM\Column(name="etat",type="string")
     */
    private $etat;
    /**
     * @param string $cin
     */
    public function setCin($cin)
    {
        $this->cin = $cin;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    public function __toString()
    {
        return $this->cin;
    }
}

