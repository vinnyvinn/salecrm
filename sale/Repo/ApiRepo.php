<?php

namespace Sale\Repo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Sale\Contracts\ControllerContract;

class ApiRepo extends Controller implements ControllerContract
{
    public static function create()
    {
        // TODO: Implement create() method.
    }

    public static function store(Model $model, array $data)
    {
        return $model::create($data);
    }

    public static function delete()
    {
        // TODO: Implement delete() method.
    }

    public static function show()
    {
        // TODO: Implement show() method.
    }

    public static function edit()
    {
        // TODO: Implement edit() method.
    }

    public static function index(Model $model, array $queryScope = null)
    {
        $query = $model;
        $i = 0;

        foreach ($queryScope as $key => $value){
//            if ($i == 0){
                $query->where($key,$value);
//            }

//            else{

//            }
//            $i = $i + 1;
        }

        return $queryScope == null ? $model->all() : $query->get();
    }

    public static function validateApiRequest(Request $request, array $rules)
    {
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
//            dd($validator->messages());
            return false;
        }

        return true;
    }

    public static function responseError($errorMsg, $httpCode = Response::HTTP_OK)
    {
        return response(['success' => false, 'error' => $errorMsg], $httpCode);
    }

    public static function responseSuccess(array $data, $index, $httpCode = Response::HTTP_OK)
    {
        return response(['success' => true, $index => $data]);
    }

    public function getModelWith(Model $model)
    {

    }

}
