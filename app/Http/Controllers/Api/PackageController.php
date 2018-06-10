<?php

namespace App\Http\Controllers\Api;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Transformers\PackageTransformers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class PackageController extends Controller
{
    //
    public function packages()
    {
      $packages = Package::all();
      return fractal()
            ->item($packages)
            ->transformWith( new PackageTransformers)
            ->toArray();
    }
}