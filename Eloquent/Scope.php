<?php

namespace IgniteKit\Backports\Database\Eloquent;

interface Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \IgniteKit\Backports\Database\Eloquent\Builder  $builder
     * @param  \IgniteKit\Backports\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model);
}
