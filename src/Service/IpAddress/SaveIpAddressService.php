<?php

namespace App\Service\IpAddress;

use App\Entity\IpAddress;
use App\Exception\IpAddressNotFoundException;
use App\Repository\IpAddressRepository;
use DateTime;
use Symfony\Component\Security\Core\Security;

/**
 * Class SaveIpAddressService
 * @package App\Service\User
 */
class SaveIpAddressService implements SaveIpAddressServiceInterface
{
    private Security $security;
    protected IpAddressRepository $ipAddressRepository;

    /**
     * @param Security $security
     * @param IpAddressRepository $ipAddressRepository
     */
    public function __construct(
        Security $security,
        IpAddressRepository $ipAddressRepository
    ) {
        $this->security = $security;
        $this->ipAddressRepository = $ipAddressRepository;
    }

    /**
     * @param $data
     * @throws IpAddressNotFoundException
     */
    public function execute($data)
    {
        $ipAddress = new IpAddress();

        if ($data->id) {
            // Get existing IP address object
            $ipAddress = $this->ipAddressRepository->find($data->id);
            if (!$ipAddress) {
                throw new IpAddressNotFoundException();
            }
        }

        $ipAddress->setIpAddress($data->ipAddress);
        $ipAddress->setLabel($data->label);
        $ipAddress->setUserCreate($this->security->getUser());

        if ($data->id) {
            $ipAddress->setDateUpdate(new DateTime());
            $ipAddress->setUserCreate($this->security->getUser());

            // Update
            $this->ipAddressRepository->update($ipAddress);
        }

        // Add
        $this->ipAddressRepository->add($ipAddress);
    }
}