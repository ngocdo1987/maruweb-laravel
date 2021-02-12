<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CommonSetting\StoreCommonSettingRequest;
use App\Http\Requests\CommonSetting\UpdateCommonSettingRequest;

use App\Services\CommonSettingService;
use App\Models\CommonSetting;

class CommonSettingController extends Controller
{
    protected $service;

    public function __construct(CommonSettingService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $commonSettings = $this->service->searchAdvanced();
        $roles = auth()->user()->getRoleNames();
        $currentRole = isset($roles[0]) ? $roles[0] : '';

        return view('admin.common_settings.index', compact('commonSettings', 'currentRole'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.common_settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommonSettingRequest $request)
    {
        try {
            $this->service->storeCommonSetting($request);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die('');
            return redirect()->back()->withErrors(['message' => $e->getMessage()])->withInput();
        }

        $url = route('admin.commonSettings.index');
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
        $commonSetting = CommonSetting::findOrFail($id);

        return view('admin.common_settings.show', compact('commonSetting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commonSetting = CommonSetting::findOrFail($id);

        return view('admin.common_settings.edit', compact('commonSetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommonSettingRequest $request, $id)
    {
        try {
            $this->service->updateCommonSetting($request);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()])->withInput();
        }

        $url = route('admin.commonSettings.edit', $id).'?page='.request()->page;
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
        CommonSetting::destroy($id);

        $url = route('admin.commonSettings.index').'?page='.request()->page;
        return redirect($url)->with('success', __('Deleted successfully'));
    }
}
