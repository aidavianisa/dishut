<?php

namespace App\Http\Controllers\Api;

use App\Models\Courier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\CourierTransformers;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected function guard()
    {
      return Auth::guard('api');
    }

    public function register(Request $request, Courier $courier)
    {
      $this->validate($request, [
        'courier_number' => 'required|numeric|unique:couriers',
        'courier_name' => 'required',
        'courier_address' => 'required',
        'courier_phone' => 'required',
        'courier_password' => 'required|min:6',
      ]);

      $couriers = $courier->create([
        'courier_number' => $request->courier_number,
        'courier_name' => $request->courier_name,
        'courier_address' => $request->courier_address,
        'courier_phone' => $request->courier_phone,
        'courier_password' => bcrypt($request->courier_password),
        'courier_api_token' => bcrypt($request->courier_number),
      ]);

      $response =  fractal()
                  ->item($couriers)
                  ->transformWith( new CourierTransformers)
                  ->toArray();

      return Response::json($response, 201);
    }

    public function login(Request $request, Courier $courier)
    {
      $this->validate($request, [
        'courier_number' => 'required|numeric',
        'courier_password' => 'required|min:6',
      ]);
      $couriers = $courier::where('courier_number', $request->courier_number)->first();

      if ((@$couriers->courier_number !== $request->courier_number) && (!Hash::check($request->courier_password,  @$couriers->courier_password))) {
          return Response::json(['error' => 'Your credential is wrong'], 401);
      }

      $response =  fractal()
                  ->item($couriers)
                  ->transformWith( new CourierTransformers)
                  ->addMeta([
                    'token' => $couriers->api_token
                  ])
                  ->toArray();
      return Response::json($response );
    }

    public function profile(Courier $courier)
    {
      $user = $this->guard()->user();
      $couriers = $courier::find($user->id);
      $response =  fractal()
                  ->item($couriers)
                  ->transformWith( new CourierTransformers)
                  ->toArray();
      return Response::json($response);
    }
}