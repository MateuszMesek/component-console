<?php declare(strict_types=1);

namespace MateuszMesek\Component\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface ExecutorInterface
{
    public function execute(InputInterface $input, OutputInterface $output): int;
}
