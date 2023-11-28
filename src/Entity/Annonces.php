<?php

namespace App\Entity;

use App\Repository\AnnoncesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnnoncesRepository::class)
 */
class Annonces
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $dateMiseEnLigne;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $statut;

    /**
     * @ORM\Column(type="text")
     */
    private $lienDossier;

    /**
     * @ORM\OneToOne(targetEntity = "App\Entity\Logements")
     * @ORM\JoinColumn(name="idLogement", referencedColumnName= "id")
     */
    private $logements;

    /** Getters et Setters */

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

    public function getDateMiseEnLigne(): ?\DateTimeInterface
    {
        return $this->dateMiseEnLigne;
    }

    public function setDateMiseEnLigne(\DateTimeInterface $dateMiseEnLigne): self
    {
        $this->dateMiseEnLigne = $dateMiseEnLigne;

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

    public function getLienDossier(): ?string
    {
        return $this->lienDossier;
    }

    public function setLienDossier(string $lienDossier): self
    {
        $this->lienDossier = $lienDossier;

        return $this;
    }

    public function getLogements(): ?Logements
    {
        return $this->logements;
    }

    public function setLogements(?Logements $logements): self
    {
        $this->logements = $logements;

        return $this;
    }
}
