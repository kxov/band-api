<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine;

use App\Shared\Application\Event\EventBusInterface;
use App\Shared\Domain\Model\Aggregate;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class DomainEventSubscriber implements EventSubscriber
{
    /**
     * @var Aggregate[]
     */
    private array $entities = [];

    private EventBusInterface $eventBus;
    private ContainerInterface $container;

    public function __construct(EventBusInterface $eventBus, ContainerInterface $containerBag)
    {
        $this->eventBus = $eventBus;
        $this->container = $containerBag;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postRemove,
            Events::postFlush,
            Events::onFlush,
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->keepAggregateRoots($args);
    }

    public function onFlush(OnFlushEventArgs $args): void
    {
        $om = $args->getObjectManager();
        $uw = $om->getUnitOfWork();

        foreach ($uw->getScheduledCollectionUpdates() as $collection) {
            $entity = $collection->getOwner();

            $this->entities[] = $entity;
        }
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $this->keepAggregateRoots($args);
    }

    public function postFlush(PostFlushEventArgs $args): void
    {
        foreach ($this->entities as $entity) {
            foreach ($entity->popEvents() as $event) {
                $this->eventBus->execute($event);
            }
        }
    }

    private function keepAggregateRoots(LifecycleEventArgs $args): void
    {
        $object = $args->getObject();

        if (!($object instanceof Aggregate)) {
            return;
        }

        $this->entities[] = $object;
    }
}