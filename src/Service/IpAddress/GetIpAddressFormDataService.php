<?php

namespace App\Service\IpAddress;

use App\Exception\IpAddressNotFoundException;
use App\Repository\IpAddressRepository;

/**
 * Class GetIpAddressFormDataService
 * @package App\Service\IpAddress
 */
class GetIpAddressFormDataService implements GetIpAddressFormDataServiceInterface
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
     * @return array
     * @throws IpAddressNotFoundException
     */
    public function execute(string $id): array
    {
        $ipAddress = $this->ipAddressRepository->find($id);
        if (!$ipAddress) {
            throw new IpAddressNotFoundException();
        }

        return [
            'id' => $ipAddress->getId(),
            'ipAddress' => $ipAddress->getIpAddress(),
            'label' => $ipAddress->getLabel(),
//            'acl' => $ipAddress->getAccess() ? $object->getAccess() : []
        ];
    }
}