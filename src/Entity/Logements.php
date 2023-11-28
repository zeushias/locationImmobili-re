<?php

namespace App\Entity;

use App\Repository\LogementsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LogementsRepository::class)
 */
class Logements
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity = "App\Entity\TypeLogement")
     * @ORM\JoinColumn(name="idTypeLogement", referencedColumnName= "id")
     */
    private $typeLogement;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPieces;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroEtage;

    /**
     * @ORM\Column(type="float")
     */
    private $superficie;

    /**
     * @ORM\Column(type="text")
     */
    private $proprietaire;

    /**
     * @ORM\Column(type="text")
     */
    private $adresseComplete;

    /**
     * @ORM\Column(type="text")
     */
    private $cp;

    /**
     * @ORM\Column(type="text")
     */
    private $ville;

    /**
     * @ORM\Column(type="text")
     */
    private $pays;

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

    public function getNbPieces(): ?int
    {
        return $this->nbPieces;
    }

    public function setNbPieces(int $nbPieces): self
    {
        $this->nbPieces = $nbPieces;

        return $this;
    }

    public function getNumeroEtage(): ?int
    {
        return $this->numeroEtage;
    }

    public function setNumeroEtage(int $numeroEtage): self
    {
        $this->numeroEtage = $numeroEtage;

        return $this;
    }

    public function getSuperficie(): ?float
    {
        return $this->superficie;
    }

    public function setSuperficie(float $superficie): self
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getProprietaire(): ?string
    {
        return $this->proprietaire;
    }

    public function setProprietaire(string $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    public function getAdresseComplete(): ?string
    {
        return $this->adresseComplete;
    }

    public function setAdresseComplete(string $adresseComplete): self
    {
        $this->adresseComplete = $adresseComplete;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getTypeLogement(): ?TypeLogement
    {
        return $this->typeLogement;
    }

    public function setTypeLogement(?TypeLogement $typeLogement): self
    {
        $this->typeLogement = $typeLogement;

        return $this;
    }

}
