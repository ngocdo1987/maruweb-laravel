<?php
namespace App\Traits\Crud;

use Illuminate\Http\Request;
use App\Http\Requests\Crud\StoreRequest;
use App\Http\Requests\Crud\UpdateRequest;

trait CrudIndexTrait
{
    protected $service;
    protected $beforeService;
    protected $singular = 'dummy'; // change it
    protected $plural = 'dummies'; // change it
    protected $viewPath = 'admin.dummies.'; // change it

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $compact = [];

        $compact = $this->beforeService->beforeIndex($compact);

        return view($this->viewPath.'index', $compact);
    }
}