<?php

namespace App\Http\Controllers;

use App\Handler\OrganizationHandler;
use App\Handler\PharmaciesHandler;
use App\Http\Requests\OrganizationAddRequest;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class PharmaciesController extends Controller
{
    public function pharmacy(Request $request, PharmaciesHandler $handler) {
        return $handler($request);
    }

}
