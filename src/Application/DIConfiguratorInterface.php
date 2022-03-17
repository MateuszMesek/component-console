<?php declare(strict_types=1);

namespace MateuszMesek\Component\Console\Application;

use Psr\Container\ContainerInterface;

interface DIConfiguratorInterface
{
    public function configure(ContextInterface $context): ContainerInterface;
}
