<?php
namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ActivityLogService extends AbstractEloquentService
{
    public function __construct(ActivityLog $model)
    {
        $this->model = $model;
    }

    public function storeActivityLog($model, $prefix, $action)
    {
        if (auth()->guard('admin')->check() && isset(auth()->guard('admin')->user()->id) && isset($model->id)) {
            ActivityLog::create([
                'admin_id' => auth()->guard('admin')->user()->id,
                'menu' => array_search($prefix, config('constants.activity_log.menu')),
                'action_type' => array_search($action, config('constants.activity_log.action_type')),
                'ref_id' => $model->id
            ]);
        }
    }

    public function getByAdminId($adminId, $offset)
    {
        $activityLogs = ActivityLog::where('admin_id', $adminId)
                                    ->orderBy('id', 'DESC');

        $count = count($activityLogs->get());

        $activityLogs = $activityLogs->skip($offset)->take(config('constants.activity_log.per_page'))->get();

        return [
            $activityLogs,
            $count
        ];
    }
}
