<?php

namespace App\Service\IpAddress;

use App\Repository\IpAddressRepository;
use Exception;

/**
 * Class CheckIfIpAddressExistService
 * @package App\Service\IpAddress
 */
class CheckIfIpAddressExistService implements CheckIfIpAddressExistServiceInterface
{
    protected IpAddressRepository $ipAddressRepository;

    /**
     * @param IpAddressRepository $ipAddressRepository
     */
    public function __construct(IpAddressRepository $ipAddressRepository)
    {
        $this->ipAddressRepository = $ipAddressRepository;
    }

    /**
     * @param string $id
     * @param $ipAddress
     * @return bool
     */
    public function execute(string $id, $ipAddress): bool
    {
        try {
            $ipAddress = $this->ipAddressRepository->findOneBy(['ip_address' => $ipAddress]);

            if (!$ipAddress) {
                return false;
            }

            if ($ipAddress->getId() == $id) {
                return false;
            }

            return true;
        } catch (Exception $exception) {
            return true;
        }
    }
}