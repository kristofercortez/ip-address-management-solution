<?php

namespace App\Service\IpAddress;

/**
 * Interface GetIpAddressFormDataServiceInterface
 * @package App\Service\IpAddress
 */
interface GetIpAddressFormDataServiceInterface
{
    /**
     * @param string $id
     * @return mixed
     */
    public function execute(string $id): array;
}