<?php

namespace AchatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Fournisseur
 *
 * @ORM\Table(name="fournisseur")
 * @ORM\Entity(repositoryClass="AchatBundle\Repository\FournisseurRepository")
 */
class Fournisseur
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
     * @var string
     *
     * @ORM\Column(name="raisonSociale", type="string", length=255)
     */
    private $raisonSociale;

    /**
     * @var int
     *
     * @ORM\Column(name="numeroTelephone", type="integer")
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = "le numero de telephone doit comporter 8 chiffres",
     *      maxMessage = "le numero de telephone doit comporter 8 chiffres"
     *
     * )
     ** @Assert\NotNull(message="Le numero de telephone doit etre non null ")
     */
    private $numeroTelephone;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseMail", type="string", length=255)
     */
    private $adresseMail;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculeFiscale", type="string", length=255)
     */
    private $matriculeFiscale;

    /**
     * @var int
     *
     * @ORM\Column(name="codePostale", type="integer")
     */
    private $codePostale;


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
     * Set raisonSociale
     *
     * @param string $raisonSociale
     *
     * @return Fournisseur
     */
    public function setRaisonSociale($raisonSociale)
    {
        $this->raisonSociale = $raisonSociale;

        return $this;
    }

    /**
     * Get raisonSociale
     *
     * @return string
     */
    public function getRaisonSociale()
    {
        return $this->raisonSociale;
    }

    /**
     * Set numeroTelephone
     *
     * @param integer $numeroTelephone
     *
     * @return Fournisseur
     */
    public function setNumeroTelephone($numeroTelephone)
    {
        $this->numeroTelephone = $numeroTelephone;

        return $this;
    }

    /**
     * Get numeroTelephone
     *
     * @return int
     */
    public function getNumeroTelephone()
    {
        return $this->numeroTelephone;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Fournisseur
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
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

    /**
     * Set adresseMail
     *
     * @param string $adresseMail
     *
     * @return Fournisseur
     */
    public function setAdresseMail($adresseMail)
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }

    /**
     * Get adresseMail
     *
     * @return string
     */
    public function getAdresseMail()
    {
        return $this->adresseMail;
    }

    /**
     * Set matriculeFiscale
     *
     * @param string $matriculeFiscale
     *
     * @return Fournisseur
     */
    public function setMatriculeFiscale($matriculeFiscale)
    {
        $this->matriculeFiscale = $matriculeFiscale;

        return $this;
    }

    /**
     * Get matriculeFiscale
     *
     * @return string
     */
    public function getMatriculeFiscale()
    {
        return $this->matriculeFiscale;
    }

    /**
     * Set codePostale
     *
     * @param integer $codePostale
     *
     * @return Fournisseur
     */
    public function setCodePostale($codePostale)
    {
        $this->codePostale = $codePostale;

        return $this;
    }

    /**
     * Get codePostale
     *
     * @return int
     */
    public function getCodePostale()
    {
        return $this->codePostale;
    }
}

