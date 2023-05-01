<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface DataRequestInterface
{
    public function setUpDataRequest(Request $request);
}
