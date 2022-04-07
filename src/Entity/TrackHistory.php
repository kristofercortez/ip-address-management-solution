<?php

namespace App\Entity;

/**
 * Trait TrackHistory
 * @package App\Entity
 */
trait TrackHistory
{
    /**
     * @ORM\Column(type="string", length=250, nullable=false)
     */
    protected $description;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    protected $data;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $data
     * @return $this
     */
    public function setData($data): self
    {
        $this->data = $data;
        return $this;
    }
}
