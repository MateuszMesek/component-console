<?php declare(strict_types=1);

namespace MateuszMesek\Component\Console;

use MateuszMesek\Component\Console\Command\ConfiguratorInterface;
use MateuszMesek\Component\Console\Command\ExecutorInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class Command extends BaseCommand
{
    public function __construct(
        private LoggerInterface       $logger,
        private ConfiguratorInterface $configurator,
        private ExecutorInterface     $executor
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->configurator->configure($this);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            return $this->executor->execute($input, $output);
        } catch (Throwable $exception) {
            $this->logger->emergency($exception);

            return 1;
        }
    }
}
