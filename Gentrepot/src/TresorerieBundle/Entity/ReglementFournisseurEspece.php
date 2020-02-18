<?php

namespace TresorerieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReglementFournisseurEspece
 *
 * @ORM\Table(name="reglement_fournisseur_espece")
 * @ORM\Entity(repositoryClass="TresorerieBundle\Repository\ReglementFournisseurEspeceRepository")
 */
class ReglementFournisseurEspece extends ReglementFournisseur
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
     * @ORM\ManyToOne(targetEntity="FactureAchat")
     * @ORM\JoinColumn(name="numeroF_factureAchat",referencedColumnName="numeroF")
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

