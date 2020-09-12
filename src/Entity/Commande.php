<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 * @ApiResource(
 *  normalizationContext={
 *      "groups"={"commandes_read"}
 *  }
 * )
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"commandes_read", "users_read", "livraisons_read", "factures_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Groups({"commandes_read", "users_read", "livraisons_read", "factures_read"})
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"commandes_read", "users_read", "livraisons_read", "factures_read"})
     * @Assert\NotBlank(message="Le statut de la commande est obligatoire")
     */
    private $statut;

    /**
     * @ORM\Column(type="date")
     * @Groups({"commandes_read", "users_read", "livraisons_read", "factures_read"})
     */
    private $dateCom;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"commandes_read", "livraisons_read", "factures_read"})
     */
    private $idUser;

    /**
     * @ORM\OneToMany(targetEntity=Livraison::class, mappedBy="idCom")
     * @Groups({"commandes_read", "users_read"})
     */
    private $livraisons;

    /**
     * @ORM\OneToMany(targetEntity=Facture::class, mappedBy="idCom")
     * @Groups({"commandes_read", "users_read"})
     */
    private $factures;

    public function __construct()
    {
        $this->livraisons = new ArrayCollection();
        $this->factures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDateCom(): ?\DateTimeInterface
    {
        return $this->dateCom;
    }

    public function setDateCom(\DateTimeInterface $dateCom): self
    {
        $this->dateCom = $dateCom;

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

    /**
     * @return Collection|Livraison[]
     */
    public function getLivraisons(): Collection
    {
        return $this->livraisons;
    }

    public function addLivraison(Livraison $livraison): self
    {
        if (!$this->livraisons->contains($livraison)) {
            $this->livraisons[] = $livraison;
            $livraison->setIdCom($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): self
    {
        if ($this->livraisons->contains($livraison)) {
            $this->livraisons->removeElement($livraison);
            // set the owning side to null (unless already changed)
            if ($livraison->getIdCom() === $this) {
                $livraison->setIdCom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Facture[]
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Facture $facture): self
    {
        if (!$this->factures->contains($facture)) {
            $this->factures[] = $facture;
            $facture->setIdCom($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->contains($facture)) {
            $this->factures->removeElement($facture);
            // set the owning side to null (unless already changed)
            if ($facture->getIdCom() === $this) {
                $facture->setIdCom(null);
            }
        }

        return $this;
    }
}
