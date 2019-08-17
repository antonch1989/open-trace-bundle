<?php

namespace Plugsurfing\OpenTraceBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Plugsurfing\OpenTraceBundle\DependencyInjection\PlugsurfingOpenTraceExtension;

class PlugsurfingOpenTraceBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new PlugsurfingOpenTraceExtension();
    }
}
