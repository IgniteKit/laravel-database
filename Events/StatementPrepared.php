<?php

namespace IgniteKit\Backports\Database\Events;

class StatementPrepared
{
    /**
     * The database connection instance.
     *
     * @var \IgniteKit\Backports\Database\Connection
     */
    public $connection;

    /**
     * The PDO statement.
     *
     * @var \PDOStatement
     */
    public $statement;

    /**
     * Create a new event instance.
     *
     * @param  \IgniteKit\Backports\Database\Connection  $connection
     * @param  \PDOStatement  $statement
     * @return void
     */
    public function __construct($connection, $statement)
    {
        $this->statement = $statement;
        $this->connection = $connection;
    }
}
