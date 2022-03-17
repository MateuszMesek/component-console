<?php declare(strict_types=1);

namespace MateuszMesek\Component\Console\Application;

use MateuszMesek\Component\Console\ApplicationInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

interface ContextInterface
{
    public function getApplication(): ApplicationInterface;

    public function getInput(): InputInterface;

    public function getOutput(): OutputInterface;
}
