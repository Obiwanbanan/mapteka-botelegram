<?php

namespace App\Http\Controllers;

use App\Handler\OrganizationHandler;
use App\Handler\PharmaciesHandler;
use App\Http\Requests\OrganizationAddRequest;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class OrganizationsController extends Controller
{
    public function organizations(Request $request, OrganizationHandler $handler) {
        return $handler($request);
    }

    public function dashboard(Request $request, OrganizationHandler $handler) {
        return $handler($request);
    }

    public function settings(Request $request, OrganizationHandler $handler) {
        return $handler($request);
    }

    public function index() {
        return view('home');
    }

    public function addOrganization(Request $request, OrganizationHandler $handler) {
        return $handler($request);
    }
    public function removeOrganization(Request $request, OrganizationHandler $handler) {
        return $handler($request);
    }

    public function getPharmacies(Request $request, PharmaciesHandler $handler) {
        return $handler($request);
    }

    public function organizationPage(Request $request, OrganizationHandler $handler) {
        return $handler($request);

    }

}
