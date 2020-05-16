<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployRepository")
 */
class Employ
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Departement", inversedBy="employees")
     */
    private $departement;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FicheServiceEmployer", mappedBy="employe")
     */
    private $ficheserviceemployes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
    private $fonction;

    public function __construct()
    {
        $this->ficheserviceemployes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
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

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(string $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * @return Collection|FicheServiceEmployer[]
     */
    public function getFicheserviceemployes(): Collection
    {
        return $this->ficheserviceemployes;
    }

    public function addFicheserviceemploye(FicheServiceEmployer $ficheserviceemploye): self
    {
        if (!$this->ficheserviceemployes->contains($ficheserviceemploye)) {
            $this->ficheserviceemployes[] = $ficheserviceemploye;
            $ficheserviceemploye->setEmploye($this);
        }

        return $this;
    }

    public function removeFicheserviceemploye(FicheServiceEmployer $ficheserviceemploye): self
    {
        if ($this->ficheserviceemployes->contains($ficheserviceemploye)) {
            $this->ficheserviceemployes->removeElement($ficheserviceemploye);
            // set the owning side to null (unless already changed)
            if ($ficheserviceemploye->getEmploye() === $this) {
                $ficheserviceemploye->setEmploye(null);
            }
        }

        return $this;
    }

   

}
