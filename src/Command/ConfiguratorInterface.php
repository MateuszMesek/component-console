<?php declare(strict_types=1);

namespace MateuszMesek\Component\Console\Command;

use Symfony\Component\Console\Command\Command;

interface ConfiguratorInterface
{
    public function configure(Command $command): void;
}
