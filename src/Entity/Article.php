<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)  <!-- Allow 2 decimal places -->
     */
    private $prix;

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

    // ✅ Return as string (Doctrine stores decimal as string), but we'll cast in forms
    public function getPrix(): ?string
    {
        return $this->prix;
    }

    // ✅ Accept float or string, but store as string (Doctrine requirement)
    public function setPrix($prix): self
    {
        // Normalize: ensure it's a number with 2 decimals
        if (is_numeric($prix)) {
            $this->prix = number_format((float)$prix, 2, '.', '');
        } else {
            $this->prix = '0.00';
        }
        return $this;
    }
}