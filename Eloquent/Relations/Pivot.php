<?php

namespace IgniteKit\Backports\Database\Eloquent\Relations;

use IgniteKit\Backports\Database\Eloquent\Model;
use IgniteKit\Backports\Database\Eloquent\Relations\Concerns\AsPivot;

class Pivot extends Model
{
    use AsPivot;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
