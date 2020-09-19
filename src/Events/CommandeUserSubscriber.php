<?php

namespace App\Events;

use App\Entity\Commande;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CommandeUserSubscriber implements EventSubscriberInterface
{
    private $security;

    public function __contruct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['setUserForCommande', EventPriorities::PRE_VALIDATE]
        ];
    }

    public function setUserForCommande(ViewEvent $event)
    {
        $commande = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($commande instanceof Commande && $method === "Post") {
            $user = $this->security->getUser();
            $commande->setUser($user);
        }
    }
}
