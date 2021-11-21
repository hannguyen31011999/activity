<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    protected $codeSuccess = 200;
    protected $codeAuthentication = 401;
    protected $codeFails = 500;
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
