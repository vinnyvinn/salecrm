<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 7/28/18
 * Time: 8:22 AM
 */

namespace Sale\Abs;


use Illuminate\Database\Eloquent\Model;
use Sale\Traits\SaleTrait;

abstract class SaleModelAbs extends Model
{
    use SaleTrait;
}