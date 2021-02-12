<?php
namespace App\Traits\Crud;

use Illuminate\Http\Request;
use App\Http\Requests\Crud\StoreRequest;
use App\Http\Requests\Crud\UpdateRequest;

trait CrudCreateTrait
{
    protected $service;
    protected $beforeService;
    protected $singular = 'dummy'; // change it
    protected $plural = 'dummies'; // change it
    protected $viewPath = 'admin.dummies.'; // change it

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $compact = [];

        $compact = $this->beforeService->beforeCreate($compact);

        return view($this->viewPath.'create', $compact);
    }
}