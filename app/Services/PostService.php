<?php
namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostService extends AbstractEloquentService
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function searchAdvanced($request, $paginate = 0)
    {
        $data = $request->all();

        $posts = Post::select('id', 'created_at', 'updated_at')
            ->where(function ($query) use ($data) {
                
            });
        
        if ($paginate == 1) {
            return $posts->latest()->paginate(config('constants.post.per_page'));
        } else {
            return $posts->get();
        }
    }

    // Store new post
    public function storePost($request)
    {
        $data = $request->all();

        $post = Post::create($data);

        return $post->id;
    }

    // Update existing post
    public function updatePost($request)
    {
        $data = $request->all();

        $post = Post::findOrFail($data['id']);
        $post->update($data);

        return $post->id;
    }

    // Destroy post
    public function destroyPost($id)
    {
        Post::destroy($id);
    }
}
