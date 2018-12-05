<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateMobileRequest;
use App\Transformers\MobileTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MobileController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(CreateMobileRequest $request)
     {
         $mobile=\Auth::user()->mobiles()->create($request->all());

         $transformed=\Fractal::item($mobile,new MobileTransformer())->toArray();

         return response()->json(['message'=>'success','data'=>$transformed],201);

     }
}
