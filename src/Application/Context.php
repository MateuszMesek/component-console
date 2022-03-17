<?php declare(strict_types=1);

namespace MateuszMesek\Component\Console\Application;

use MateuszMesek\Component\Console\ApplicationInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Context implements ContextInterface
{
    public function __construct(
        private ApplicationInterface $application,
        private InputInterface       $input,
        private OutputInterface      $output
    )
    {
    }

    public function getApplication(): ApplicationInterface
    {
        return $this->application;
    }

    public function getInput(): InputInterface
    {
        return $this->input;
    }

    public function getOutput(): OutputInterface
    {
        return $this->output;
    }
}