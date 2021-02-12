<?php
namespace App\Traits;

use Illuminate\Http\Request;
use App\Http\Requests\Crud\StoreRequest;
use App\Http\Requests\Crud\UpdateRequest;

trait CrudTrait
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $compact = [];
        $compact = $this->beforeService->beforeShow($compact);

        return view($this->viewPath.'show', $compact);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $compact = [];
        $compact = $this->beforeService->beforeEdit($compact);

        return view($this->viewPath.'edit', $compact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $funcName = 'update'.ucfirst($this->singular);
            $this->service->{$funcName}($request);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()])->withInput();
        }

        $url = route($this->viewPath.'edit', $id).'?page='.request()->page;
        return redirect($url)->with('success', __('Save successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $funcName = 'destroy'.ucfirst($this->singular);
        $this->service->{$funcName}($id);

        $url = route($this->viewPath.'index').'?page='.request()->page;
        return redirect($url)->with('success', __('Deleted successfully'));
    }
}