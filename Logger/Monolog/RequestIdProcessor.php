<?php

namespace Plugsurfing\OpenTraceBundle\Logger\Monolog;

use Monolog\Processor\ProcessorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class RequestIdProcessor implements ProcessorInterface
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function __invoke(array $record): array
    {
        if (!$this->requestStack->getCurrentRequest() instanceof Request ||
            !$requestId = $this->requestStack->getCurrentRequest()->headers->get('x-request-id')
        ) {
            return $record;
        }

        $record['extra']['x-request-id'] = $requestId;

        return $record;
    }
}
