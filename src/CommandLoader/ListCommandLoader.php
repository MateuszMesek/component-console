<?php declare(strict_types=1);

namespace MateuszMesek\Component\Console\CommandLoader;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;

class ListCommandLoader implements CommandLoaderInterface
{
    private ?array $instances = null;

    /**
     * @param ContainerInterface $container
     * @param string[] $commands
     */
    public function __construct(
        private ContainerInterface $container,
        private array              $commands
    )
    {
    }

    public function get(string $name): Command
    {
        return $this->getInstances()[$name];
    }

    public function has(string $name): bool
    {
        return isset($this->getInstances()[$name]);
    }

    public function getNames(): array
    {
        return array_keys($this->getInstances());
    }

    private function getInstances(): array
    {
        if (null === $this->instances) {
            $this->instances = [];

            foreach ($this->commands as $command) {
                $instance = $this->container->get($command);

                $this->instances[$instance->getName()] = $instance;
            }
        }

        return $this->instances;
    }
}
