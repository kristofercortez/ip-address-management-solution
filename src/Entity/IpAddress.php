<?php

namespace App\Entity;

use App\Repository\IpAddressRepository;
use Doctrine\ORM\Mapping as ORM;
use stdClass;

/**
 * @ORM\Entity
 * @ORM\Table(name="`ip_address`")
 */
class IpAddress
{
    use GeneratedId;
    use TrackCreate;
    use TrackUpdate;

    /**
     * @ORM\Column(type="string", length=30, unique=true, nullable=false)
     */
    protected $ip_address;

    /**
     * @ORM\Column(type="string", length=180)
     */
    protected $label;

    /**
     * @ORM\OneToMany(targetEntity="IpAddressHistory", mappedBy="ip_address")
     */
    private $data_histories;

    public function __construct()
    {
        $this->initGeneratedID();
        $this->initTrackCreate();
        $this->initTrackUpdate();
    }

    /**
     * @return string|null
     */
    public function getIpAddress(): ?string
    {
        return $this->ip_address;
    }

    /**
     * @param string $ipAddress
     * @return $this
     */
    public function setIpAddress(string $ipAddress): self
    {
        $this->ip_address = $ipAddress;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return $this
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataHistories()
    {
        return $this->data_histories;
    }

    /**
     * @return stdClass
     */
    public function toData()
    {
        $data = new stdClass();
        $this->dataGeneratedID($data);
        $this->dataTrackCreate($data);
        $this->dataTrackUpdate($data);
        $data->ip_address = $this->ip_address;
        $data->label = $this->label;
        return $data;
    }
}
