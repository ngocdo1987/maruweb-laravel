@extends('layouts.admin.app')

@section('title', __('Edit admin'))

@section('content')
    <div class="col-lg-12 col-xs-12">
        <div class="box-content card white">
            <h4 class="box-title">
                <a href="{{ route('admin.admins.index') }}?page={{ request()->page }}">{{ __('List admins') }}</a> > 
                {{ __('Edit admin') }}
            </h4>

            @include('layouts.admin._flash_messages')

            <div class="card-content">
                <form class="form-horizontal">

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ __('Last login date') }}</label>
                        <label for="" class="col-sm-9 control-label" style="text-align: left;">
                            {{ $admin->last_login_date }}
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ __('Admin ID') }}</label>
                        <label for="" class="col-sm-9 control-label" style="text-align: left;">
                            KAN{{ str_pad($admin->id, 7, '0', STR_PAD_LEFT) }}
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ __('Name') }}</label>
                        <label for="" class="col-sm-9 control-label" style="text-align: left;">
                            {{ $admin->name }}
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ __('Email Address') }}</label>
                        <label for="" class="col-sm-9 control-label" style="text-align: left;">
                            {{ $admin->email }}
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ __('Role') }} <font color="red">※</font></label>
                        <label for="" class="col-sm-9 control-label" style="text-align: left;">
                            {{ __(ucfirst($currentRole)) }}
                        </label>
                    </div>

                    <div class="form-group margin-bottom-0">
                        <div class="col-sm-offset-3 col-sm-9">
                            <a href="{{ route('admin.admins.index').'?page='.request()->page }}" class="btn btn-warning waves-effect waves-light">
                                <i class="fa fa-chevron-circle-left"></i> {{ __('Return') }}
                            </a>
                        </div>
                    </div>

                    @include('admin.admins._activity_logs', [
                        'activityLogs' => $activityLogs,
                        'menuLinkConfig' => $menuLinkConfig,
                        'menuConfig' => $menuConfig,
                        'actionTypeConfig' => $actionTypeConfig,
                        'count' => $count
                    ])
                </form>
            </div>            
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">
    $(function() {
        $('#load_more').on('click', function() {
            $.post("{{ route('admin.admins.load_more_activity_logs') }}", {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'id': '{{ $admin->id }}',
                'offset': $('#next_offset').val()
            }, function(data, status) {
                $(data).insertBefore($('tr#load_more'));

                var next_offset = parseInt($('#next_offset').val()) + {{ config('constants.activity_log.per_page') }};
                $('#next_offset').val(next_offset);

                if (next_offset >= {{ $count }}) {
                    $('#load_more').hide();
                }
            });
        });
    });
</script>
@endsection