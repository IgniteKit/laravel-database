<?php

namespace IgniteKit\Backports\Database;

use IgniteKit\Backports\Support\Arr;
use InvalidArgumentException;
use IgniteKit\Backports\Console\Command;
use IgniteKit\Backports\Container\Container;

abstract class Seeder
{
    /**
     * The container instance.
     *
     * @var \IgniteKit\Backports\Container\Container
     */
    protected $container;

    /**
     * The console command instance.
     *
     * @var \IgniteKit\Backports\Console\Command
     */
    protected $command;

    /**
     * Seed the given connection from the given path.
     *
     * @param  array|string  $class
     * @param  bool  $silent
     * @return $this
     */
    public function call($class, $silent = false)
    {
        $classes = Arr::wrap($class);

        foreach ($classes as $class) {
            $seeder = $this->resolve($class);

            if ($silent === false && isset($this->command)) {
                $this->command->getOutput()->writeln('<info>Seeding:</info> '.get_class($seeder));
            }

            $seeder->__invoke();
        }

        return $this;
    }

    /**
     * Silently seed the given connection from the given path.
     *
     * @param  array|string  $class
     * @return void
     */
    public function callSilent($class)
    {
        $this->call($class, true);
    }

    /**
     * Resolve an instance of the given seeder class.
     *
     * @param  string  $class
     * @return \IgniteKit\Backports\Database\Seeder
     */
    protected function resolve($class)
    {
        if (isset($this->container)) {
            $instance = $this->container->make($class);

            $instance->setContainer($this->container);
        } else {
            $instance = new $class;
        }

        if (isset($this->command)) {
            $instance->setCommand($this->command);
        }

        return $instance;
    }

    /**
     * Set the IoC container instance.
     *
     * @param  \IgniteKit\Backports\Container\Container  $container
     * @return $this
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * Set the console command instance.
     *
     * @param  \IgniteKit\Backports\Console\Command  $command
     * @return $this
     */
    public function setCommand(Command $command)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Run the database seeds.
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public function __invoke()
    {
        if (! method_exists($this, 'run')) {
            throw new InvalidArgumentException('Method [run] missing from '.get_class($this));
        }

        return isset($this->container)
                    ? $this->container->call([$this, 'run'])
                    : $this->run();
    }
}
