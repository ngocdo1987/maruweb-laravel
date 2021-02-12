<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Services\DashboardService;
use DB;

class DashboardController extends Controller
{
    public $service;

    public function __construct(DashboardService $service)
    {
        $this->service  = $service ;
    }
    public function index()
    {
        $data = $this->service->getDashboard();
        return view('admin.dashboard.index', $data);
    }
}
