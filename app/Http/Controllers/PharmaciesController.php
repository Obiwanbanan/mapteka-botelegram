<?php

namespace App\Http\Controllers;

use App\Handler\PharmaciesHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class PharmaciesController extends Controller
{
    public function pharmacy(
        Request $request,
        PharmaciesHandler $handler
    ): JsonResponse
    {
        return $handler($request);
    }

}
