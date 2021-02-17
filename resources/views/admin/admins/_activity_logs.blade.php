<div class="form-group">
    <label for="" class="col-sm-3 control-label">
        <h4>{{ __('Activity logs') }}</h4>
    </label>
    <div class="col-sm-9">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('Datetime') }}</th>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Activity log detail') }}</th>
                    </tr>
                </thead>
                <tbody>
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

                        @if ($count > config('constants.activity_log.per_page'))
                            <tr id="load_more">
                                <td colspan="3" style="text-align: center;">
                                    <input type="hidden" id="next_offset" value="{{ config('constants.activity_log.per_page') }}" />

                                    <button type="button" id="load_more" class="btn btn-xs btn-primary waves-effect waves-light">
                                        {{ __('Load more') }}
                                    </button>
                                </td>
                            </tr>
                        @endif
                        
                    @else
                        <tr>
                            <td colspan="3">
                                <center><font color="red">{{ __('Records not found') }}</font></center>
                            </td>
                        </tr>
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
</div>