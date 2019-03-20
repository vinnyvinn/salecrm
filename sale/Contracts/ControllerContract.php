<?php
/**
 * Created by PhpStorm.
 * User: marvin
 * Date: 7/27/18
 * Time: 5:57 PM
 */

namespace Sale\Contracts;


use Illuminate\Database\Eloquent\Model;

interface ControllerContract
{
    public static function create();
    public static function store(Model $model, array $data);
    public static function edit();
    public static function show();
    public static function delete();
    public static function index(Model $model, array $queryScope = null);
}