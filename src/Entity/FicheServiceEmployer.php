<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FicheServiceEmployerRepository")
 */
class FicheServiceEmployer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employ", inversedBy="ficheserviceemployes")
     */
    private $employe;


    public function getId(): ?int
    {
        return $this->id;
    }
}
