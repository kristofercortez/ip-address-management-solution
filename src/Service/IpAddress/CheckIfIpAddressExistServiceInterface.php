<?php

namespace App\Service\IpAddress;

/**
 * Interface CheckIfIpAddressExistServiceInterface
 * @package App\Service\IpAddress
 */
interface CheckIfIpAddressExistServiceInterface
{
    /**
     * @param string $id
     * @param $ipAddress
     * @return bool
     */
    public function execute(string $id, $ipAddress): bool;
}