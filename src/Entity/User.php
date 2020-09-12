<?php

namespace App\Entity;

use App\Entity\Avis;
use App\Entity\Commande;
use App\Entity\ShippingAdress;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource(
 *  normalizationContext={
 *      "groups"={"users_read"}
 *  }
 * )
 * @UniqueEntity("email", message="Un utilisateur ayant cette adresse email existe déja")
 * @ApiFilter(SearchFilter::class, properties={"firstName", "lastName"})
 * @ApiFilter(OrderFilter::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"users_read", "commandes_read", "factures_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"users_read", "commandes_read", "factures_read"})
     * @Assert\NotBlank(message="L'adresse email de user est obligatoire")
     * @Assert\Email(message="Le format de l'adresse email doit être valide")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"users_read", "factures_read", "factures_read"})
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"users_read"})
     * @Assert\NotBlank(message="Le mot de passe est obligatoire")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users_read", "commandes_read", "factures_read"})
     * @Assert\NotBlank(message="Le prénom du user est obligatoire")
     * @Assert\Length(min=3, minMessage="le prénom doit faire entre 3 et 255 caractères", max=255,
     * maxMessage="Le prénom doit faire entre 3 et 255 caractères")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users_read", "commandes_read", "factures_read"})
     * @Assert\NotBlank(message="Le nom de famille du user est obligatoire")
     * @Assert\Length(min=3, minMessage="le nom de famille doit faire entre 3 et 255 caractères", max=255,
     * maxMessage="Le nom de famille doit faire entre 3 et 255 caractères")
     */
    private $lastName;
    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="idUser")
     * @Groups({"users_read"})
     * @ApiSubresource
     */
    private $commandes;

    /**
     * @ORM\OneToMany(targetEntity=Avis::class, mappedBy="idUser")
     * @Groups({"users_read"})
     */
    private $listeAvis;

    /**
     * @ORM\ManyToMany(targetEntity=ShippingAdress::class, inversedBy="users")
     * @Groups({"users_read", "commandes_read", "factures_read"})
     */
    private $UserAddresses;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"users_read", "commandes_read", "factures_read"})
     */
    private $phoneNumber;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->listeAvis = new ArrayCollection();
        $this->UserAddresses = new ArrayCollection();
    }

    /**
     * Permet de récupérer le total des commandes
     * @Groups({"users_read"})
     * @return float
     */
    public function getTotalMontant(): float
    {
        return array_reduce($this->commandes->toArray(), function ($total, $commande) {
            return $total + $commande->getMontant();
        }, 0);
    }

    /**
     * Récupérer le montant non payé (montant tatal hors factures payées ou annulées)
     * @Groups({"users_read"})
     * @return float
     */
    public function getUnpaidMontant(): float
    {
        return array_reduce($this->commandes->toArray(), function ($total, $commande) {
            return $total + ($commande->getStatut() === "PAID" || $commande->getStatut() === "CANCELLED" ? 0 :
            $commande->getMontant());
        }, 0);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setIdUser($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getIdUser() === $this) {
                $commande->setIdUser(null);
            }
        }

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
            $listeAvi->setIdUser($this);
        }

        return $this;
    }

    public function removeListeAvi(Avis $listeAvi): self
    {
        if ($this->listeAvis->contains($listeAvi)) {
            $this->listeAvis->removeElement($listeAvi);
            // set the owning side to null (unless already changed)
            if ($listeAvi->getIdUser() === $this) {
                $listeAvi->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ShippingAdress[]
     */
    public function getUserAddresses(): Collection
    {
        return $this->UserAddresses;
    }

    public function addUserAddress(ShippingAdress $userAddress): self
    {
        if (!$this->UserAddresses->contains($userAddress)) {
            $this->UserAddresses[] = $userAddress;
        }

        return $this;
    }

    public function removeUserAddress(ShippingAdress $userAddress): self
    {
        if ($this->UserAddresses->contains($userAddress)) {
            $this->UserAddresses->removeElement($userAddress);
        }

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}
