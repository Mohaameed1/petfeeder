<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Systeme
 *
 * @ORM\Table(name="systeme")
 * @ORM\Entity
 */
class Systeme
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=false)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="nv_stock", type="string", length=255,  nullable=false)
     */
    private $nvStock;

    /**
     * @var string
     *
     * @ORM\Column(name="nv_eau", type="string", length=255, nullable=false)
     */
    private $nvEau;

    /**
     * @var string
     *
     * @ORM\Column(name="seuil_stock", type="string", length=255,  nullable=false)
     */
    private $seuilStock;

    /**
     * @var string
     *
     * @ORM\Column(name="seuil_eau", type="string", length=255,  nullable=false)
     */
    private $seuilEau;

    /**
     * @var bool
     *
     * @ORM\Column(name="eclairage", type="boolean", nullable=false)
     */
    private $eclairage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $date = 'CURRENT_TIMESTAMP';

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="systemes")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setSystemes($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getSystemes() === $this) {
                $user->setSystemes(null);
            }
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEtat(): string
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat(string $etat): void
    {
        $this->etat = $etat;
    }

    /**
     * @return float
     */
    public function getNvStock(): float
    {
        return $this->nvStock;
    }

    /**
     * @param float $nvStock
     */
    public function setNvStock(float $nvStock): void
    {
        $this->nvStock = $nvStock;
    }

    /**
     * @return float
     */
    public function getNvEau(): float
    {
        return $this->nvEau;
    }

    /**
     * @param float $nvEau
     */
    public function setNvEau(float $nvEau): void
    {
        $this->nvEau = $nvEau;
    }

    /**
     * @return float
     */
    public function getSeuilStock(): float
    {
        return $this->seuilStock;
    }

    /**
     * @param float $seuilStock
     */
    public function setSeuilStock(float $seuilStock): void
    {
        $this->seuilStock = $seuilStock;
    }

    /**
     * @return float
     */
    public function getSeuilEau(): float
    {
        return $this->seuilEau;
    }

    /**
     * @param float $seuilEau
     */
    public function setSeuilEau(float $seuilEau): void
    {
        $this->seuilEau = $seuilEau;
    }

    /**
     * @return bool
     */
    public function isEclairage(): bool
    {
        return $this->eclairage;
    }

    /**
     * @param bool $eclairage
     */
    public function setEclairage(bool $eclairage): void
    {
        $this->eclairage = $eclairage;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    public function __toString(){
        // to show the name of the Category in the select
        return $this->etat;
        // to show the id of the Category in the select
        // return $this->id;
    }

}
