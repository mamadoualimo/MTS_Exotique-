<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 * @ApiResource(
 *  normalizationContext={
 *      "groups"={"produits_read"}
 *  }
 * )
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"produits_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"produits_read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"produits_read"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"produits_read"})
     */
    private $categorie;

    /**
     * @ORM\Column(type="float")
     * @Groups({"produits_read"})
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"produits_read"})
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"produits_read"})
     */
    private $qteStock;

    /**
     * @ORM\ManyToOne(targetEntity=LigneCom::class, inversedBy="produits")
     * @Groups({"produits_read"})
     */
    private $no;

    /**
     * @ORM\OneToMany(targetEntity=Avis::class, mappedBy="idProduit")
     * @Groups({"produits_read"})
     */
    private $listeAvis;

    /**
     * @ORM\OneToMany(targetEntity=LigneCom::class, mappedBy="idProduit")
     * @Groups({"produits_read"})
     */
    private $ligneCommandes;

    public function __construct()
    {
        $this->listeAvis = new ArrayCollection();
        $this->ligneCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
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

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getQteStock(): ?int
    {
        return $this->qteStock;
    }

    public function setQteStock(int $qteStock): self
    {
        $this->qteStock = $qteStock;

        return $this;
    }

    public function getNo(): ?LigneCom
    {
        return $this->no;
    }

    public function setNo(?LigneCom $no): self
    {
        $this->no = $no;

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getListeAvis(): Collection
    {
        return $this->listeAvis;
    }

    public function addListeAvi(Avis $listeAvi): self
    {
        if (!$this->listeAvis->contains($listeAvi)) {
            $this->listeAvis[] = $listeAvi;
            $listeAvi->setIdProduit($this);
        }

        return $this;
    }

    public function removeListeAvi(Avis $listeAvi): self
    {
        if ($this->listeAvis->contains($listeAvi)) {
            $this->listeAvis->removeElement($listeAvi);
            // set the owning side to null (unless already changed)
            if ($listeAvi->getIdProduit() === $this) {
                $listeAvi->setIdProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LigneCom[]
     */
    public function getLigneCommandes(): Collection
    {
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCom $ligneCommande): self
    {
        if (!$this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes[] = $ligneCommande;
            $ligneCommande->setIdProduit($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCom $ligneCommande): self
    {
        if ($this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes->removeElement($ligneCommande);
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getIdProduit() === $this) {
                $ligneCommande->setIdProduit(null);
            }
        }

        return $this;
    }
}
