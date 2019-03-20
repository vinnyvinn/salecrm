<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 7/28/18
 * Time: 8:24 AM
 */

namespace Sale\Traits;


use Sale\Scope\TrashedScope;

trait SaleTrait
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TrashedScope());
    }
}