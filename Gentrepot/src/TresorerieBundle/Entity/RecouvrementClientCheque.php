<?php

namespace TresorerieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecouvrementClientCheque
 *
 * @ORM\Table(name="recouvrement_client_cheque")
 * @ORM\Entity(repositoryClass="TresorerieBundle\Repository\RecouvrementClientChequeRepository")
 */
class RecouvrementClientCheque extends RecouvrementClient
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

    private $dateCheque;

    /**
     * @return mixed
     */
    public function getDateCheque()
    {
        return $this->dateCheque;
    }

    /**
     * @param mixed $dateCheque
     */
    public function setDateCheque($dateCheque)
    {
        $this->dateCheque = $dateCheque;
    }

    /**
     * @return mixed
     */
    public function getNumeroCheque()
    {
        return $this->numeroCheque;
    }

    /**
     * @param mixed $numeroCheque
     */
    public function setNumeroCheque($numeroCheque)
    {
        $this->numeroCheque = $numeroCheque;
    }


    /**
     * @ORM\Column(type="integer")
     */
    private $numeroCheque;


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
     * @ORM\ManyToOne(targetEntity="VenteBundle\Entity\FactureVente")
     * @ORM\JoinColumn(name="idF_factureVente",referencedColumnName="id")
     */
    private $facture;

    /**
     * @return mixed
     */
    public function getFacture()
    {
        return $this->facture;
    }

    /**
     * @param mixed $facture
     */
    public function setFacture($facture)
    {
        $this->facture = $facture;
    }
}

