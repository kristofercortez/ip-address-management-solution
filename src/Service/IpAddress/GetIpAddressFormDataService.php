<?php

namespace App\Service\IpAddress;

use App\Exception\IpAddressNotFoundException;
use App\Repository\IpAddressRepository;
use App\Utility\DatetimeUtility;

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

        // Get data histories
        $histories = [];
        foreach ($ipAddress->getDataHistories() as $history) {
            $histories[] = [
                'date' => $history->getDateCreate()->format(DatetimeUtility::FULL_DATE_AND_TIME),
                'description' => $history->getDescription(),
                'author' => $history->getUserCreate() ?
                    $history->getUserCreate()->getFirstName() . ' ' . $history->getUserCreate()->getLastName() : []
            ];
        }

        return [
            'id' => $ipAddress->getId(),
            'ipAddress' => $ipAddress->getIpAddress(),
            'label' => $ipAddress->getLabel(),
            'histories' => $histories
        ];
    }
}