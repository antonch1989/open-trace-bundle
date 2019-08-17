<?php

namespace Plugsurfing\OpenTraceBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class OpenTracingSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [KernelEvents::RESPONSE => 'onKernelResponse'];
    }

    /**
     * Puts open trace headers from request to a response
     * In purpose to pass them to another micro service if there is a cross service request.
     */
    public function onKernelResponse(FilterResponseEvent $event): void
    {
        $request  = $event->getRequest();
        $response = $event->getResponse();

        $openTraceHeaders = ['x-request-id', 'x-b3-traceid', 'x-b3-spanid', 'x-b3-parentspanid', 'x-b3-sampled', 'x-b3-flags', 'x-ot-span-context'];

        foreach ($openTraceHeaders as $openTraceHeader) {
            if ($request->headers->get($openTraceHeader)) {
                $response->headers->set($openTraceHeader, $request->headers->get($openTraceHeader));
            }
        }
    }
}
