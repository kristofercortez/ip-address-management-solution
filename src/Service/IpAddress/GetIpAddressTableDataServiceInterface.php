<?php

namespace App\Service\IpAddress;

/**
 * Interface GetIpAddressTableDataServiceInterface
 * @package App\Service\IpAddress
 */
interface GetIpAddressTableDataServiceInterface
{
    /**
     * @param $currentPage
     * @param $limit
     * @return array
     */
    public function execute($currentPage, $limit): array;
}