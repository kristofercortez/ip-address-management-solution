<?php

namespace App\Entity;

use App\Utility\DatetimeUtility;
use DateTime;

/**
 * Trait TrackUpdate
 * @package App\Entity
 */
trait TrackUpdate
{
    /** @ORM\Column(type="datetime", options={"default": "CURRENT_TIMESTAMP"}) */
    protected $date_update;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_update_id", referencedColumnName="id")
     */
    protected $user_update;

    /**
     * Initialize the date_update
     */
    public function initTrackUpdate()
    {
        $this->date_update = new DateTime();
    }

    /**
     * @return mixed
     */
    public function getDateUpdate()
    {
        return $this->date_update;
    }

    /**
     * @param $dateUpdate
     * @return $this
     */
    public function setDateUpdate($dateUpdate): self
    {
        $this->date_update = $dateUpdate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserUpdate()
    {
        return $this->user_update;
    }

    /**
     * @param $userUpdate
     * @return $this
     */
    public function setUserUpdate($userUpdate): self
    {
        $this->user_update = $userUpdate;
        return $this;
    }

    /**
     * @param $data
     */
    protected function dataTrackUpdate($data)
    {
        $data->date_update = $this->date_update->format(DatetimeUtility::DATETIME_DB_FORMAT);
        $data->user_update = $this->user_update?->getId();
    }
}
