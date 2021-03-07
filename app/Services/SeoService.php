<?php
namespace App\Services;

use App\Models\Seo;
use Illuminate\Support\Facades\DB;

class SeoService extends AbstractEloquentService
{
    public function __construct(Seo $model)
    {
        $this->model = $model;
    }

    // Get SEO meta data by model name and model id
    public function getSeoByModel($modelName, $modelId)
    {
        return Seo::select('id', 'slug', 'meta_title', 'meta_desc', 'meta_keyword')
                    ->where('model', $modelName)
                    ->where('model_id', $modelId)
                    ->first();
    }

    // Get SEO meta data by slug (URL key)
    public function getSeoBySlug($slug)
    {
        return Seo::select('id', 'slug', 'meta_title', 'meta_desc', 'meta_keyword')
                    ->where('slug', $slug)
                    ->first();
    }

    // Store new SEO
    public function storeSeo($request)
    {
        $data = $request->all();

        $seo = Seo::create($data);

        return $seo->id;
    }

    // Update existing SEO
    public function updateSeo($request)
    {
        $data = $request->all();

        $seo = Seo::where('model', $data['model'])
                    ->where('model_id', $data['model_id'])
                    ->first();

        $seo->update($data);

        return $seo->id;
    }

    // Destroy SEO by model name & model id
    public function destroySeoByModel($modelName, $modelId)
    {
        return Seo::where('model', $modelName)
                    ->where('model_id', $modelId)
                    ->delete();
    }
}
