<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 7/28/18
 * Time: 8:17 AM
 */

namespace Sale\Scope;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TrashedScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('trashed', 0);
    }
}