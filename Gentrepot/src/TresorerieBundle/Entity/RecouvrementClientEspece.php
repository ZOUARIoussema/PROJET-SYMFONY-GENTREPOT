<?php

namespace TresorerieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecouvrementClientEspece
 *
 * @ORM\Table(name="recouvrement_client_espece")
 * @ORM\Entity(repositoryClass="TresorerieBundle\Repository\RecouvrementClientEspeceRepository")
 */
class RecouvrementClientEspece extends RecouvrementClient
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

