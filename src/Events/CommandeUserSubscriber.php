<?php

namespace App\Events;

use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CommandeUserSubscriber implements EventSubscriberInterface
{
    private $security;
    private $repository;

    public function __construct(Security $security, CommandeRepository $repository)
    {
        $this->security = $security;
        // $this->repository = $repository;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents:: VIEW => ['setUserForCommande', EventPriorities::PRE_VALIDATE]
        ];
    }

    public function setUserForCommande(ViewEvent $event)
    {
        $commande = $event->getControllerResult();
        
        $method = $event->getRequest()->getMethod();
        
        if ($commande instanceof Commande && $method === 'POST') {
            $user = $this->security->getUser();
            $commande->setIdUser($user);
        }
    }
}
