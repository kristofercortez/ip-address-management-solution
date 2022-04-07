<?php

namespace App\EventListener;

use App\Entity\IpAddress;
use App\Entity\IpAddressHistory;
use App\Service\General\CreateHistoryServiceInterface;
use App\Utility\HistoryAction;
use Doctrine\Persistence\Event\LifecycleEventArgs;

/**
 * Class EntityHistoryListener
 * @package App\EventListener
 */
class EntityHistoryListener
{
    protected CreateHistoryServiceInterface $createHistoryService;

    /**
     * @param CreateHistoryServiceInterface $createHistoryService
     */
    public function __construct(CreateHistoryServiceInterface $createHistoryService)
    {
        $this->createHistoryService = $createHistoryService;
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->logHistory(HistoryAction::ADD, $args);
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postUpdate(LifecycleEventArgs $args): void
    {
        $this->logHistory(HistoryAction::UPDATE, $args);
    }

    /**
     * @param int $action
     * @param LifecycleEventArgs $args
     */
    private function logHistory(int $action, LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if ($entity instanceof IpAddress) {
            $this->createHistoryService->createHistory(IpAddressHistory::class, $entity, HistoryAction::getLabel($action) . ' IP address');
            return;
        }
    }
}