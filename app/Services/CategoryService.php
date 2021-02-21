<?php
namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryService extends AbstractEloquentService
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function searchAdvanced($request, $paginate = 0)
    {
        $data = $request->all();

        $categories = Category::select('id', 'created_at', 'updated_at')
            ->where(function ($query) use ($data) {
                
            });
        
        if ($paginate == 1) {
            return $categories->latest()->paginate(config('constants.category.per_page'));
        } else {
            return $categories->get();
        }
    }

    // Store new category
    public function storeCategory($request)
    {
        $data = $request->all();

        $category = Category::create($data);

        return $category->id;
    }

    // Update existing category
    public function updateCategory($request)
    {
        $data = $request->all();

        $category = Category::findOrFail($data['id']);
        $category->update($data);

        return $category->id;
    }

    // Destroy category
    public function destroyCategory($id)
    {
        Category::destroy($id);
    }
}
