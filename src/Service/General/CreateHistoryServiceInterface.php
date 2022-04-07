<?php

namespace App\Service\General;

/**
 * Class CreateHistoryServiceInterface
 * @package App\Service\General
 */
interface CreateHistoryServiceInterface
{
    public function createHistory($entityClass, $object, $description);
}