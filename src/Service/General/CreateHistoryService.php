<?php

namespace App\Service\General;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Security;

/**
 * Class CreateHistoryService
 * @package App\Service\General
 */
class CreateHistoryService implements CreateHistoryServiceInterface
{
    protected EntityManagerInterface $entityManager;
    protected LoggerInterface $logger;
    private Security $security;

    /**
     * @param EntityManagerInterface $entityManager
     * @param LoggerInterface $logger
     * @param Security $security
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        LoggerInterface $logger,
        Security $security
    ) {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
        $this->security = $security;
    }

    /**
     * @param $entityClass
     * @param $object
     * @param $description
     */
    public function createHistory($entityClass, $object, $description)
    {
        $data = $object->toData();
        $loggedInUser = $this->security->getUser();
        $history = new $entityClass;
        $history->setObject($object);
        $history->setDescription($description);
        $history->setData($data);
        $history->setUserCreate($loggedInUser);

        $this->entityManager->persist($history);
        $this->entityManager->flush();
    }
}