<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 * @ApiResource(
 *  itemOperations={"GET", "PUT", "DELETE", "increment"={
 *      "method"="post",
 *      "path"="/factures/{id}/increment",
 *      "controller"="App\Controller\FactureIncrementationController",
 *      "swagger_context"={
 *          "summary"="Incrémente une facture",
 *          "description"="Incremente le date d'une facture donnée"
 *      }
 *    }
 * },
 *  attributes={
 *      "pagination_enabled"=true,
 *      "pagination_items_per_page"=20,
 *      "order": {"dateFact":"desc"}
 * },
 *  normalizationContext={"groups"={"factures_read"}},
 *  denormalizationContext={"disable_type_enforcement"=true}
 * )
 */
class Facture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"factures_read", "users_read", "commandes_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"factures_read", "users_read", "commandes_read"})\DateTimeInterface
     * @Assert\DateTime(message="La date doit être au format YYYY-MM-DD")
     * @Assert\NotBlank(message="La date d'envoi doit être renseignée")
     */
    private $dateFact;

    /**
     * @ORM\Column(type="float")
     * @Groups({"factures_read", "users_read", "commandes_read"})
     * @Assert\NotBlank(message="Le montant de la facture est obligatoire !")
     * @Assert\Type(type="numeric", message="Le montant de la facture doit être un numerique !")
     */
    private $montant;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="factures")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"factures_read"})
     */
    private $idCom;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"factures_read", "users_read", "commandes_read"})
     * @Assert\NotBlank(message="Il faut absolument un chrono pour la facture")
     * @Assert\Type(type="integer", message="Le chrono doit être un nombre !")
     */
    private $chrono;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateFact(): ?\DateTimeInterface
    {
        return $this->dateFact;
    }

    public function setDateFact($dateFact): self
    {
        $this->dateFact = $dateFact;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant($montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getIdCom(): ?Commande
    {
        return $this->idCom;
    }

    public function setIdCom(?Commande $idCom): self
    {
        $this->idCom = $idCom;

        return $this;
    }

    public function getChrono(): ?int
    {
        return $this->chrono;
    }

    public function setChrono($chrono): self
    {
        $this->chrono = $chrono;

        return $this;
    }
}
