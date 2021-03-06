<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FicheService", mappedBy="client")
     */
    private $ficheservices;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeclient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tel;

    public function __construct()
    {
        $this->ficheservices = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodeclient(): ?string
    {
        return $this->codeclient;
    }

    public function setCodeclient(string $codeclient): self
    {
        $this->codeclient = $codeclient;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection|FicheService[]
     */
    public function getFicheservices(): Collection
    {
        return $this->ficheservices;
    }

    public function addFicheservice(FicheService $ficheservice): self
    {
        if (!$this->ficheservices->contains($ficheservice)) {
            $this->ficheservices[] = $ficheservice;
            $ficheservice->setClient($this);
        }

        return $this;
    }

    public function removeFicheservice(FicheService $ficheservice): self
    {
        if ($this->ficheservices->contains($ficheservice)) {
            $this->ficheservices->removeElement($ficheservice);
            // set the owning side to null (unless already changed)
            if ($ficheservice->getClient() === $this) {
                $ficheservice->setClient(null);
            }
        }

        return $this;
    }
}
