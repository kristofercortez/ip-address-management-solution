<?php

namespace App\Entity;

use App\Utility\DatetimeUtility;
use DateTime;

/**
 * Trait TrackCreate
 * @package App\Entity
 */
trait TrackCreate
{
    /** @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"}) */
    protected $date_create;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_create_id", referencedColumnName="id")
     */
    protected $user_create;

    /**
     * Initialize the date_create
     */
    public function initTrackCreate()
    {
        $this->date_create = new DateTime();
    }

    /**
     * @return mixed
     */
    public function getDateCreate()
    {
        return $this->date_create;
    }

    /**
     * @param $dateCreate
     * @return $this
     */
    public function setDateCreate($dateCreate): self
    {
        $this->date_create = $dateCreate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserCreate()
    {
        return $this->user_create;
    }

    /**
     * @param $userCreate
     * @return $this
     */
    public function setUserCreate($userCreate): self
    {
        $this->user_create = $userCreate;
        return $this;
    }

    /**
     * @param $data
     */
    protected function dataTrackCreate($data)
    {
        $data->date_create = $this->date_create->format(DatetimeUtility::DATETIME_DB_FORMAT);
        $data->user_create = $this->user_create?->getId();
    }
}
