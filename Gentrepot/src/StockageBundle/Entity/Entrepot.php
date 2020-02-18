<?php

namespace StockageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entrepot
 *
 * @ORM\Table(name="entrepot")
 * @ORM\Entity(repositoryClass="StockageBundle\Repository\EntrepotRepository")
 */
class Entrepot
{
    /**
     * @var int
     *
     * @ORM\Column(name="matriculeFiscal", type="string")
     * @ORM\Id
     */
    private $matriculeFiscal;

    /**
     * @return int
     */
    public function getMatriculeFiscal()
    {
        return $this->matriculeFiscal;
    }

    /**
     * @param int $matriculeFiscal
     */
    public function setMatriculeFiscal($matriculeFiscal)
    {
        $this->matriculeFiscal = $matriculeFiscal;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="raisonSocial", type="string", length=255)
     */
    private $raisonSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseMail", type="string", length=255)
     */
    private $adresseMail;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroTel", type="string", length=255)
     */
    private $numeroTel;

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Entrepot
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
     * Set raisonSocial
     *
     * @param string $raisonSocial
     *
     * @return Entrepot
     */
    public function setRaisonSocial($raisonSocial)
    {
        $this->raisonSocial = $raisonSocial;

        return $this;
    }

    /**
     * Get raisonSocial
     *
     * @return string
     */
    public function getRaisonSocial()
    {
        return $this->raisonSocial;
    }

    /**
     * Set adresseMail
     *
     * @param string $adresseMail
     *
     * @return Entrepot
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
     * Set numeroTel
     *
     * @param string $numeroTel
     *
     * @return Entrepot
     */
    public function setNumeroTel($numeroTel)
    {
        $this->numeroTel = $numeroTel;

        return $this;
    }

    /**
     * Get numeroTel
     *
     * @return string
     */
    public function getNumeroTel()
    {
        return $this->numeroTel;
    }

    public function __toString()
    {
        return(String) $this->matriculeFiscal;
    }


}

