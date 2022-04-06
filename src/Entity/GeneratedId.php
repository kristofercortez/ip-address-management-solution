<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait GeneratedId
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    protected function initGeneratedID()
    {
    }

    /**
     * @return mixed
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @param $data
     */
    public function dataGeneratedID($data)
    {
        $data->id = $this->id;
    }
}
