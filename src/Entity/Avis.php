<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AvisRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AvisRepository::class)
 * @ApiResource(
 *  normalizationContext={
 *      "groups"={"aviss_read"}
 *  }
 * )
 */
class Avis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"aviss_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"aviss_read"})
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     * @Groups({"aviss_read"})
     */
    private $datePub;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"aviss_read"})
     */
    private $evaluation;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="listeAvis")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"aviss_read"})
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="listeAvis")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"aviss_read"})
     */
    private $idProduit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDatePub(): ?\DateTimeInterface
    {
        return $this->datePub;
    }

    public function setDatePub(\DateTimeInterface $datePub): self
    {
        $this->datePub = $datePub;

        return $this;
    }

    public function getEvaluation(): ?string
    {
        return $this->evaluation;
    }

    public function setEvaluation(string $evaluation): self
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdProduit(): ?Produit
    {
        return $this->idProduit;
    }

    public function setIdProduit(?Produit $idProduit): self
    {
        $this->idProduit = $idProduit;

        return $this;
    }
}
