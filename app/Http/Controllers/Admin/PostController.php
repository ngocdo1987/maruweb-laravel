<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;

use App\Services\PostService;
use App\Models\Post;

class PostController extends Controller
{
    protected $service;

    public function __construct(PostService $service)
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
        $posts = $this->service->searchAdvanced($request, 1);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        try {
            $id = $this->service->storePost($request);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die('');
            return redirect()->back()->withErrors(['message' => $e->getMessage()])->withInput();
        }

        $url = route('admin.posts.edit', $id).'?page='.request()->page;
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
        $post = Post::findOrFail($id);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        try {
            $this->service->updatePost($request);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die('');
            return redirect()->back()->withErrors(['message' => $e->getMessage()])->withInput();
        }

        $url = route('admin.posts.edit', $id).'?page='.request()->page;
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
        try {
            $this->service->destroyPost($request);
        } catch (\Exception $e) {
            print_r($e->getMessage());
            die('');
            return redirect()->back()->withErrors(['message' => $e->getMessage()])->withInput();
        }

        $url = route('admin.posts.index').'?page='.request()->page;
        return redirect($url)->with('success', __('Deleted successfully'));
    }
}
