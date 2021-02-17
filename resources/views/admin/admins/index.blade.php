@extends('layouts.admin.app')

@section('title', __('List admins'))

@section('content')
    <div class="col-xs-12">
        <div class="box-content">
            <h4 class="box-title">{{ __('List admins') }}</h4>

            @include('layouts.admin._flash_messages')

            <div class="row">
                <div class="col-sm-12">
                    <a href="{{ route('admin.admins.create') }}?page={{ request()->page }}" class="btn btn-primary waves-effect waves-light">
                        <i class="fa fa-plus-circle"></i> {{ __('Create a new account') }}
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td></td>
                            <td>
                                <input type="text" id="search_name" class="form-control" value="{{ request()->search_name }}" placeholder="{{ __('Name') }}" />
                            </td>
                            <td>
                                <input type="text" id="search_email" class="form-control" value="{{ request()->search_email }}" placeholder="{{ __('Email Address') }}" />
                            </td>
                            <td>
                                <select id="search_role" class="form-control">
                                    <option value="">--</option>
                                    @foreach ($roleConfig as $role)
                                        @php 
                                            $selected = $role == request()->search_role ? ' selected' : '';
                                        @endphp
                                        <option value="{{ $role }}"{{ $selected }}>{{ __(ucfirst($role)) }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" id="search_from_last_login_date" class="form-control" value="{{ request()->search_from_last_login_date }}" placeholder="{{ date('Y-m-d') }}" />
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" id="search_multiple">
                                    <i class="ico ti-search"></i> {{ __('Search') }}
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="text" id="search_to_last_login_date" class="form-control" value="{{ request()->search_to_last_login_date }}" placeholder="{{ date('Y-m-d') }}" />
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>{{ __('Admin ID') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Email Address') }}</th>
                            <th>{{ __('Role') }}</th>
                            <th>{{ __('Last login date') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($admins) > 0)
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.admins.edit', $admin->id) }}">
                                            <b>KAN{{ str_pad($admin->id, 7, '0', STR_PAD_LEFT) }}</b>
                                        </a>
                                        
                                    </td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ __(ucfirst($admin->role_name)) }}</td>
                                    <td>{{ $admin->last_login_date }}</td>
                                    <td>
                                        
                                            <a href="{{ route('admin.admins.edit', $admin->id) }}?page={{ request()->page }}" class="btn btn-primary btn-circle btn-xs waves-effect waves-light">
                                                <i class="ico fa fa-edit"></i>
                                            </a>
                                        @if ($admin->id != auth()->user()->id)
                                            <form action="{{ route('admin.admins.destroy', $admin->id) }}" id="delete_admin_{{ $admin->id }}" method="POST" style="display: inline">
                                                @csrf
                                                @method('DELETE')

                                                <input type="hidden" name="page" value="{{ request()->page }}" />

                                                <a href="javascript:void(0)" onclick="event.preventDefault(); if (confirm('{{ __('Are you sure to delete ?') }}')){
                                                    $('#delete_admin_{{ $admin->id }}').submit();
                                                }" class="btn btn-danger btn-circle btn-xs waves-effect waves-light delete_admin">
                                                    <i class="ico fa fa-trash"></i>
                                                </a>
                                            </form>    
                                        @endif
                                        
                                        
                                    </td>
                                </tr>
                            @endforeach
                        @else 
                            <tr>
                                <td colspan="6">
                                    <center><font color="red">{{ __('Records not found') }}</font></center>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{ $admins->appends(request()->input())->links() }}
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            $('#search_from_last_login_date').datepicker({
                format: "yyyy-mm-dd",
                changeYear: true,
                changeMonth: true,
                yearRange: "1900:{{ date('Y') + 5 }}",
                defaultDate: "{{ date('Y-m-d') }}",
                onSelect: function(e, inst) {
                    $('#search_to_last_login_date').datepicker("option", "minDate", e);
                }
            });

            $('#search_to_last_login_date').datepicker({
                format: "yyyy-mm-dd",
                changeYear: true,
                changeMonth: true,
                yearRange: "1900:{{ date('Y') + 5 }}",
                defaultDate: "{{ date('Y-m-d') }}",
                onSelect: function(e, inst) {
                    $('#search_from_last_login_date').datepicker("option", "maxDate", e);
                }
            });
            $.datepicker.setDefaults({
                closeText: "关闭",
                prevText: "&#x3C;上月",
                nextText: "下月&#x3E;",
                currentText: "今天",
                monthNamesShort: [ "1月","2月","3月","4月","5月","6月",
                    "7月","8月","9月","10月","11月","12月" ],
                dayNamesMin: [ "日","月","火","水","木","金","土" ],
                weekHeader: "周",
                dateFormat: "yy-mm-dd",
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: true,
                yearSuffix: "年"
            });

            $('#search_multiple').on('click', function() {
                var search_name = $('#search_name').val();
                var search_email = $('#search_email').val();
                var search_role = $('#search_role').val();
                var search_from_last_login_date = $('#search_from_last_login_date').val();
                var search_to_last_login_date = $('#search_to_last_login_date').val();

                if (search_name == '' && search_email == '' && search_role == '' && search_from_last_login_date == '' && search_to_last_login_date == '') {
                    window.location = '{{ route('admin.admins.index') }}';
                } else {
                    window.location = '{{ route('admin.admins.index') }}?search_name=' + search_name + '&search_email=' + search_email + '&search_role=' + search_role + '&search_from_last_login_date=' + search_from_last_login_date + '&search_to_last_login_date=' + search_to_last_login_date;
                }
            });
        });
    </script>    
@endsection