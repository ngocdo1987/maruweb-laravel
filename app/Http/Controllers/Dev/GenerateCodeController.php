<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\GenerateCodeService;

class GenerateCodeController extends Controller
{
    protected $service;

    public function __construct(GenerateCodeService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return view('dev.generate_code.index');
    }
}