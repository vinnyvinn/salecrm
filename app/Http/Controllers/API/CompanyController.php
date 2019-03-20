<?php

namespace App\Http\Controllers\API;

use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
    	$model = new Company;
    	$query = $model->newQuery();
    	return response()->json([
    		'status' => 'success',
    		'data' => $query->get()
    	]);
    }
}
