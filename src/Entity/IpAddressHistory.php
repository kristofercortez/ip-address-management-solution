<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="`ip_address_history`")
 */
class IpAddressHistory
{
    use GeneratedId;
    use TrackHistory;
    use TrackCreate;

    /**
     * @ORM\ManyToOne(targetEntity="IpAddress")
     * @ORM\JoinColumn(name="ip_address_id", referencedColumnName="id")
     */
    protected $ip_address;

    /**
     * IpAddressHistory constructor.
     */
    public function __construct()
    {
        $this->initGeneratedID();
        $this->initTrackCreate();
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->ip_address;
    }

    /**
     * @param $ipAddress
     * @return $this
     */
    public function setObject($ipAddress): self
    {
        $this->ip_address = $ipAddress;
        return $this;
    }
}
