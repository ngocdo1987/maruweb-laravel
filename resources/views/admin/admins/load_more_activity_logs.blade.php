@if (count($activityLogs) > 0)
    @foreach ($activityLogs as $log)
        <tr> 
            <td>{{ $log->created_at }}</td>
            <td>
                <a href="{{ isset($menuLinkConfig[$log->menu]) ? route('admin.'.$menuLinkConfig[$log->menu], $log->ref_id) : 'javascript:void(0)' }}">
                    <b>{{ isset($menuConfig[$log->menu]) ? $menuConfig[$log->menu] : '' }}{{ $log->ref_id > 0 ? str_pad($log->ref_id, 7, '0', STR_PAD_LEFT) : '' }}</b>
                </a>
            </td>
            <td>{{ isset($actionTypeConfig[$log->action_type]) ? __($actionTypeConfig[$log->action_type]) : '' }}</td>
        </tr>
    @endforeach
@endif