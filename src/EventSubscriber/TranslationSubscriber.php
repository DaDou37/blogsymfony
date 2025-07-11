<?php

namespace App\EventSubscriber;

use App\Service\DataBaseTranslater;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class TranslationSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private DataBaseTranslater $dataBaseTranslater
    ){}

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 20]
        ];
    }

    public function onKernelRequest(RequestEvent $event)
    {
        if(!$event->isMainRequest()){
            return;
        }
        $this->dataBaseTranslater->loadTranslations();
    }
}