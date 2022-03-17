<?php declare(strict_types=1);

namespace MateuszMesek\Component\Console;

use MateuszMesek\Component\Console\Application\Context;
use MateuszMesek\Component\Console\Application\ContextInterface;
use MateuszMesek\Component\Console\Application\DIConfiguratorInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class Application extends BaseApplication implements ApplicationInterface
{
    private ContextInterface $context;
    private ContainerInterface $container;

    public function __construct(
        private DIConfiguratorInterface $DIConfigurator,
        string                          $name = 'UNKNOWN',
        string                          $version = 'UNKNOWN'
    )
    {
        parent::__construct($name, $version);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws Throwable
     */
    public function doRun(InputInterface $input, OutputInterface $output): int
    {
        $this->configureApplication($input, $output);

        return parent::doRun($input, $output);
    }

    private function configureApplication(InputInterface $input, OutputInterface $output): void
    {
        $this->context = new Context(
            $this,
            $input,
            $output
        );

        $this->configureDI();
        $this->configureCommandLoader();
    }

    private function configureDI(): void
    {
        $this->container = $this->DIConfigurator->configure(
            $this->context
        );
    }

    private function configureCommandLoader(): void
    {
        if (!$this->container->has(CommandLoaderInterface::class)) {
            return;
        }

        $this->setCommandLoader($this->container->get(CommandLoaderInterface::class));
    }
}
