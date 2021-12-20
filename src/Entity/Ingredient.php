<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=PizzaIngredients::class, mappedBy="ingredient")
     */
    private $pizzaIngredients;

    public function __construct()
    {
        $this->pizzaIngredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|PizzaIngredients[]
     */
    public function getPizzaIngredients(): Collection
    {
        return $this->pizzaIngredients;
    }

    public function addPizzaIngredient(PizzaIngredients $pizzaIngredient): self
    {
        if (!$this->pizzaIngredients->contains($pizzaIngredient)) {
            $this->pizzaIngredients[] = $pizzaIngredient;
            $pizzaIngredient->setIngredient($this);
        }

        return $this;
    }

    public function removePizzaIngredient(PizzaIngredients $pizzaIngredient): self
    {
        if ($this->pizzaIngredients->removeElement($pizzaIngredient)) {
            // set the owning side to null (unless already changed)
            if ($pizzaIngredient->getIngredient() === $this) {
                $pizzaIngredient->setIngredient(null);
            }
        }

        return $this;
    }
}
