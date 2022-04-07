<?php

namespace App\Service\IpAddress;

use App\Repository\IpAddressRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Class GetIpAddressTableDataService
 * @package App\Service\IpAddress
 */
class GetIpAddressTableDataService implements GetIpAddressTableDataServiceInterface
{
    protected EntityManagerInterface $entityManager;
    protected IpAddressRepository $ipAddressRepository;

    /**
     * @param EntityManagerInterface $entityManager
     * @param IpAddressRepository $ipAddressRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        IpAddressRepository $ipAddressRepository
    ) {
        $this->entityManager = $entityManager;
        $this->ipAddressRepository = $ipAddressRepository;
    }

    /**
     * @param $currentPage
     * @param $limit
     * @return array
     */
    public function execute($currentPage, $limit): array
    {
        $data = [];

        // Get the query
        $rawData = $this->ipAddressRepository->getTableRawQuery();

        // Use Doctrine's paginator
        $doctrinePaginator = new Paginator($rawData);

        // Get the number of records for bootstrap-vue's pagination
        $totalRecords = count($doctrinePaginator);

        // Limit result per page
        $doctrinePaginator->getQuery()
            ->setFirstResult($limit * ($currentPage -1 ))
            ->setMaxResults($limit);

        foreach ($doctrinePaginator as $object) {
            $data[] = [
                'id' => $object->getId(),
                'ipAddress' => $object->getIpAddress(),
                'label' => $object->getLabel(),
            ];
        }

        return [
            'tableData' => $data,
            'totalRecords' => $totalRecords,
            'currentPage' => $currentPage,
            'totalsRow' => ['totalRecords' => $totalRecords]
        ];
    }
}