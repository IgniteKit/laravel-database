<?php

namespace IgniteKit\Backports\Database\Events;

use IgniteKit\Backports\Database\Migrations\Migration;
use IgniteKit\Backports\Contracts\Database\Events\MigrationEvent as MigrationEventContract;

abstract class MigrationEvent implements MigrationEventContract
{
    /**
     * An migration instance.
     *
     * @var \IgniteKit\Backports\Database\Migrations\Migration
     */
    public $migration;

    /**
     * The migration method that was called.
     *
     * @var string
     */
    public $method;

    /**
     * Create a new event instance.
     *
     * @param  \IgniteKit\Backports\Database\Migrations\Migration  $migration
     * @param  string  $method
     * @return void
     */
    public function __construct(Migration $migration, $method)
    {
        $this->method = $method;
        $this->migration = $migration;
    }
}
