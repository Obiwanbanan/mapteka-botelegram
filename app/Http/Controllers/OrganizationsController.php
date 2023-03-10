<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class OrganizationsController extends Controller
{
    private $page;
    public function organizations() {
//        dd(Organization::all());
        $page = 'organizations';
        return view('home', compact('page'));
    }

    public function dashboard() {
//        dd(Organization::all());
        $page = 'dashboard';
        return view('home', compact('page'));
    }

    public function settings() {
        $page = 'settings';
        return view('home', compact('page'));
    }
}
