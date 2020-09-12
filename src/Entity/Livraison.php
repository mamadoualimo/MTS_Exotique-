<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivraisonRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LivraisonRepository::class)
 * @ApiResource(
 *  normalizationContext={
 *      "groups"={"livraisons_read"}
 *  }
 * )
 */
class Livraison
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"livraisons_read", "commandes_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups({"livraisons_read", "commandes_read"})
     */
    private $dateLiv;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="livraisons")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"livraisons_read"})
     */
    private $idCom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLiv(): ?\DateTimeInterface
    {
        return $this->dateLiv;
    }

    public function setDateLiv(\DateTimeInterface $dateLiv): self
    {
        $this->dateLiv = $dateLiv;

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
}
