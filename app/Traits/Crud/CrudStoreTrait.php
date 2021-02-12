<?php
namespace App\Traits\Crud;

use Illuminate\Http\Request;
use App\Http\Requests\Crud\StoreRequest;
use App\Http\Requests\Crud\UpdateRequest;

trait CrudStoreTrait
{
    protected $service;
    protected $beforeService;
    protected $singular = 'dummy'; // change it
    protected $plural = 'dummies'; // change it
    protected $viewPath = 'admin.dummies.'; // change it

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $funcName = 'store'.ucfirst($this->singular);
            $id = $this->service->{$funcName}($request);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die('');
            return redirect()->back()->withErrors(['message' => $e->getMessage()])->withInput();
        }

        $url = route($this->viewPath.'edit', $id).'?page='.request()->page;
        return redirect($url)->with('success', __('Save successfully'));
    }
}