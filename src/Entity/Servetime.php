<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Servetime
 *
 * @ORM\Table(name="servetime")
 * @ORM\Entity
 */
class Servetime
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $servingtime;





    public function __construct()
    {
        $this->users = new ArrayCollection();
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





    public function getServingtime(): ?\DateTimeInterface
    {
        return $this->servingtime;
    }

    public function setServingtime(?\DateTimeInterface $servingtime): self
    {
        $this->servingtime = $servingtime;

        return $this;
    }






}
