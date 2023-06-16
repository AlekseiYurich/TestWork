<?php

namespace App\Subscriber;

use App\Events\ExceptionEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            ExceptionEvents::class => 'jsonResponseException'
        ];
    }

    public function jsonResponseException(ExceptionEvents $event): string
    {
        return json_encode($event->getMessage());
    }
}