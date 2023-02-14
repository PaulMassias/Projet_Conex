<?php

namespace App\Entity;

use App\Repository\TcResultRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TcResultRepository::class)]
class Result
{

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(nullable: true)]
    private ?float $resultat = null;


    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getResultat(): ?float
    {
        return $this->resultat;
    }

    public function setResultat(?float $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }


}
