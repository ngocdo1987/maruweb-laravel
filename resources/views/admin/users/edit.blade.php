@extends('layouts.admin.app')

@section('title', __($userTypeConfig[$userType]).__('Edit'))

@section('content')
    <div class="col-lg-12 col-xs-12">
        <div class="box-content card white">
            <h4 class="box-title">
                <a href="{{ route('admin.users.index') }}">{{ __('User management') }}</a> > 
                {{ __($userTypeConfig[$userType]).__('Edit') }}
            </h4>

            @include('layouts.admin._flash_messages')

            <div class="card-content">
                <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="id" value="{{ $user->id }}" />
                    <input type="hidden" name="page" id="page" value="{{ request()->page }}" />
                    <input type="hidden" name="user_type" id="user_type" value="{{ $userType }}" />

                    <div class="form-group">
                        <label for="" class="col-sm-10 control-label"></label>
                        <label class="col-sm-2 control-label">
                            <select name="display_on_list" id="display_on_list" class="form-control">
                                <option value="">--</option>
                                @foreach ($displayOnListConfig as $k => $v)
                                    @php
                                        $selected = $k == old('display_on_list', $user->display_on_list) ? ' selected' : ''
                                    @endphp
                                    <option value="{{ $k }}"{{ $selected }}>{{ $v }}</option>
                                @endforeach
                            </select>
                            @error('display_on_list')
                                <font color="red">{{ $message }}</font>
                            @enderror
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ __('ID') }}</label>
                        <label class="col-sm-9 control-label" style="text-align: left">
                            USE{{ str_pad($user->id, 7, '0', STR_PAD_LEFT) }}
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ __('Member registration datetime') }}</label>
                        <label class="col-sm-9 control-label" style="text-align: left">
                            {{ $user->created_at }}
                        </label>
                    </div>

                    @if ($userType != 3)
                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{ __('Last settlement confirmation date') }}</label>
                            <label class="col-sm-9 control-label" style="text-align: left">
                                {{ $user->settlement_confirmation_date }} 
                                @if ($user->settlement_confirmation_flag == 1)
                                    （取消済み）
                                @endif
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">{{ __('Last deposit report date') }}</label>
                            <label class="col-sm-9 control-label" style="text-align: left">
                                {{ $user->last_deposit_report_date }}
                            </label>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ __('Last login datetime') }}</label>
                        <label class="col-sm-9 control-label" style="text-align: left">
                            {{ $user->last_login_date }}
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">{{ __('Last update date') }}</label>
                        <label class="col-sm-9 control-label" style="text-align: left">
                            {{ $user->updated_at }}
                        </label>
                    </div>

                    @include('admin.users.edit.edit_'.$userType)
                </form>

                <form action="{{ route('admin.users.destroy', $user->id) }}" id="delete_user_{{ $user->id }}" method="POST" style="display: inline">
                    @csrf
                    @method('DELETE')
        
                    <input type="hidden" name="page" value="{{ request()->page }}" />
                </form>

                <form id="create_bank_transfer_payment_form" method="POST" action="{{ route('admin.users.create-bank-transfer-payment') }}" style="display: inline">
                    @csrf
            
                    <input type="hidden" name="hidden_user_id" id="hidden_user_id" value="" />
                    <input type="hidden" name="from" value="edit" />
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript" src="/js/jquery.jpostal.js"></script>
<script type="text/javascript" src="/js/lib/validate.js"></script>
<script type="text/javascript" src="/js/lib/moment.js"></script>
<script type="text/javascript">

    $(function() {
        // Birthday
        $('#birthday').datepicker({
            format: "yyyy-mm-dd",
            changeYear: true,
            changeMonth: true,
            yearRange: "1900:2030",
            defaultDate: "{{ date('Y-m-d') }}"
        });

        // Event date
        $('.add-event-joined-date').datepicker({
            format: "yyyy-mm-dd",
            changeYear: true,
            changeMonth: true,
            yearRange: "1900:2030",
            defaultDate: "{{ date('Y-m-d') }}"
        });

        // Go back
        $('#go_back').on('click', function() {
            var back_url = "{{ route('admin.users.index').'?page='.request()->page }}";

            var ok = confirm("{{ __('Would you like to return without saving what you filled out?') }}");

            if (ok == 1) {
                window.location = back_url;
            }
        });

        $('#head_office_postcode').jpostal({
            change : '#head_office_postcode',
            postcode : [
                '#head_office_postcode',
            ],
            address : {
                '#head_office_prefecture'  : '%3',
                '#head_office_city'  : '%4%5%6',
            }
        });
        $("#head_office_postcode").keyup(function (e) {
            var value = $("#head_office_postcode").val();
            if (e.key.match(/[0-9]/) == null) {
                value = value.replace(e.key, "");
                $("#head_office_postcode").val(value);
                return;
            }

            if (value.length == 3) {
                $("#head_office_postcode").val(value + "-")
            }
        });

        $('#mailing_postcode').jpostal({
            change : '#mailing_postcode',
            postcode : [
                '#mailing_postcode',
            ],
            address : {
                '#mailing_prefecture'  : '%3',
                '#mailing_city'  : '%4%5%6',
            }
        });
        $("#mailing_postcode").keyup(function (e) {
            var value = $("#mailing_postcode").val();
            if (e.key.match(/[0-9]/) == null) {
                value = value.replace(e.key, "");
                $("#mailing_postcode").val(value);
                return;
            }

            if (value.length == 3) {
                $("#mailing_postcode").val(value + "-")
            }
        });

        $('#company_postcode').jpostal({
            change : '#company_postcode',
            postcode : [
                '#company_postcode',
            ],
            address : {
                '#company_prefecture'  : '%3',
                '#company_city'  : '%4%5%6',
            }
        });
        $("#company_postcode").keyup(function (e) {
            var value = $("#company_postcode").val();
            if (e.key.match(/[0-9]/) == null) {
                value = value.replace(e.key, "");
                $("#company_postcode").val(value);
                return;
            }

            if (value.length == 3) {
                $("#company_postcode").val(value + "-")
            }
        });

        $('#home_postcode').jpostal({
            change : '#home_postcode',
            postcode : [
                '#home_postcode',
            ],
            address : {
                '#home_prefecture'  : '%3',
                '#home_city'  : '%4%5%6',
            }
        });
        $("#home_postcode").keyup(function (e) {
            var value = $("#home_postcode").val();
            if (e.key.match(/[0-9]/) == null) {
                value = value.replace(e.key, "");
                $("#home_postcode").val(value);
                return;
            }

            if (value.length == 3) {
                $("#home_postcode").val(value + "-")
            }
        });

        // Change payment status to success
        $('.btn-payment').each(function() {
            $(this).on('click', function() {
                var paymentId = $(this).attr('data-id');

                var ok = confirm("{{ __('Would you like to send a payment confirmation email to this user?') }}");

                if (ok == 1) {
                    var paymentDate = prompt("{{ __('Please enter payment date (format yyyy-mm-dd)') }}", "{{ date('Y-m-d H:i:s') }}");

                    var checkValidDate = moment(paymentDate, formats, true).isValid();

                    //console.log(checkValidDate);

                    if (checkValidDate == true) {
                        $.post('/{{ config('auth.admin_dir') }}/payments/' + paymentId, {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            '_method': 'PATCH',
                            'id': paymentId,
                            'status': 1,
                            'created_at': paymentDate
                        }, function(data) {
                            data = data.trim();
                            if (data == paymentId) {
                                // Hide 2 buttons
                                $('#btn-payment-' + paymentId).hide();
                                $('#btn-cancel-payment-' + paymentId).hide();
                                $('#btn-payment-bis-' + paymentId).hide();
                                $('#btn-cancel-payment-bis-' + paymentId).hide();

                                // Change status text
                                $('#td_status_' + paymentId).html('{{ __('Success') }}');
                            }
                        });
                    } else {
                        alert("{{ __('Please enter valid payment date') }}");
                    }
                    
                }
            });
        });

        // Change payment status to cancelled by admin
        $('.btn-cancel-payment').each(function() {
            $(this).on('click', function() {
                var paymentId = $(this).attr('data-id');

                var ok = confirm("{{ __('Are you sure to cancel bank transfer payment?') }}");

                if (ok == 1) {
                    $.post('/{{ config('auth.admin_dir') }}/payments/' + paymentId, {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        '_method': 'PATCH',
                        'id': paymentId,
                        'status': 2
                    }, function(data) {
                        data = data.trim();
                        if (data == paymentId) {
                            // Hide 2 buttons
                            $('#btn-payment-' + paymentId).hide();
                            $('#btn-cancel-payment-' + paymentId).hide();
                            $('#btn-payment-bis-' + paymentId).hide();
                            $('#btn-cancel-payment-bis-' + paymentId).hide();

                            // Change status text
                            $('#td_status_' + paymentId).html('{{ __('Fail') }}');
                        }
                    });
                }
            });
        });

        // Change user status
        $('.btn-status').each(function() {
            $(this).on('click', function() {
                var userId = $(this).attr('data-id');
                var userStatus = $(this).attr('data-status');
                var userPassword = $('#password').val();

                if (userStatus == 0 || userStatus == '0' || userStatus == 2 || userStatus == '2') {
                    var changeUserStatus = 1;
                    var ok = confirm('{{ __("Would you like to activate your membership?") }}');
                }

                if (userStatus == 1 || userStatus == '1' || userStatus == 2 || userStatus == '2') {
                    var changeUserStatus = 0;
                    var ok = confirm('{{ __("Would you like to deactivate your membership?") }}');
                }

                if (ok == 1) {
                    $.post("{{ route('admin.users.update', $user->id) }}", {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        '_method': 'PATCH',
                        'id': userId,
                        'status': changeUserStatus,
                        'password': userPassword,
                        'action': 'update-status'
                    }, function(data) {
                        data = data.trim();
                        if (data == userId) {
                            if (changeUserStatus == 1) {
                                $('#btn-status-' + userId).attr('data-status', '1');
                                $('#btn-status-' + userId).attr('class', 'btn btn-xs btn-danger btn-status');
                                $('#btn-status-' + userId).html('<span>{{ __('Off') }}</span>');

                                $('#btn-leave-' + userId).attr('data-status', '1');
                            }
                            
                            if (changeUserStatus == 0) {
                                $('#btn-status-' + userId).attr('data-status', '0');
                                $('#btn-status-' + userId).attr('class', 'btn btn-xs btn-success btn-status');
                                $('#btn-status-' + userId).html('<span>{{ __('On') }}</span>');

                                $('#btn-leave-' + userId).attr('data-status', '0');
                            }
                        }
                    }).fail(function(data, status) {
                        if (status == 'error') {
                            data = JSON.parse(JSON.stringify(data));
                            var errors = "";

                            //console.log(data.responseJSON.errors.subject);

                            if (typeof data.responseJSON.errors.password !== 'undefined') {
                                var error_password = data.responseJSON.errors.password;
                                errors += "{{ __('Password') }}: " + error_password + "\n";
                            }

                            alert(errors);
                            
                        }
                    });
                }
                
            });
        });

        // Leave
        $('.btn-leave').each(function() {
            $(this).on('click', function() {
                var userId = $(this).attr('data-id');
                var userStatus = $(this).attr('data-status');
                var userPassword = $('#password').val();

                // Unsubscribe
                if (userStatus == 0 || userStatus == '0' || userStatus == 1 || userStatus == '1') {
                    var ok = confirm('{{ __("Do you want to withdraw this member?") }}');

                    if (ok == 1) {
                        $.post("{{ route('admin.users.destroy', $user->id) }}", {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            '_method': 'DELETE',
                            'id': userId
                        }, function(data) {
                            data = data.trim();
                            if (data == userId) {
                                $('#btn-leave-' + userId).attr('data-status', '2');
                                $('#btn-leave-' + userId).attr('class', 'btn btn-xs btn-danger btn-leave');
                                $('#btn-leave-' + userId).html('<i class="ico fa fa-trash"></i> <span>{{ __('Unsubscribed') }}</span>');

                                // On
                                $('#btn-status-' + userId).attr('data-status', '2');
                                $('#btn-status-' + userId).attr('class', 'btn btn-xs btn-success btn-status');
                                $('#btn-status-' + userId).html('<span>{{ __('On') }}</span>');
                            }
                        }).fail(function(data, status) {
                            if (status == 'error') {
                                data = JSON.parse(JSON.stringify(data));
                                var errors = "";

                                console.log(data);
                            }
                        });
                    }
                }

                // Enable again
                if (userStatus == 2 || userStatus == '2') {
                    var changeUserStatus = 1;
                    var ok = 1;

                    if (ok == 1) {
                        $.post("{{ route('admin.users.update', $user->id) }}", {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            '_method': 'PATCH',
                            'id': userId,
                            'status': changeUserStatus,
                            'password': userPassword,
                            'action': 'update-status'
                        }, function(data) {
                            data = data.trim();
                            if (data == userId) {
                                if (changeUserStatus == 1) {
                                    $('#btn-status-' + userId).attr('data-status', '1');
                                    $('#btn-status-' + userId).attr('class', 'btn btn-xs btn-danger btn-status');
                                    $('#btn-status-' + userId).html('<span>{{ __('Off') }}</span>');

                                    $('#btn-leave-' + userId).attr('data-status', '1');
                                    $('#btn-leave-' + userId).attr('class', 'btn btn-xs btn-danger btn-leave');
                                    $('#btn-leave-' + userId).html('<i class="ico fa fa-trash"></i> <span>{{ __('Leave') }}</span>');
                                }
                                
                                /*
                                if (changeUserStatus == 0) {
                                    $('#btn-status-' + userId).attr('data-status', '0');
                                    $('#btn-status-' + userId).attr('class', 'btn btn-xs btn-success btn-status');
                                    $('#btn-status-' + userId).html('<span>{{ __('On') }}</span>');

                                    $('#btn-leave-' + userId).attr('data-status', '0');
                                }
                                */
                            }
                        }).fail(function(data, status) {
                            if (status == 'error') {
                                data = JSON.parse(JSON.stringify(data));
                                var errors = "";

                                //console.log(data.responseJSON.errors.subject);

                                if (typeof data.responseJSON.errors.password !== 'undefined') {
                                    var error_password = data.responseJSON.errors.password;
                                    errors += "{{ __('Password') }}: " + error_password + "\n";
                                }

                                alert(errors);
                                
                            }
                        });
                    }                    
                }
                
            });
        });

        // Add event
        $('.btn-add-event-joined-date').each(function() {
            $(this).on('click', function() {
                var eventType = $(this).attr('data-id');
                var joinedDate = $('#add_event_joined_date_' + eventType).val();

                $.post("{{ route('admin.users.events.store') }}", {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'user_id': {{ $user->id }},
                    'joined_date': joinedDate,
                    'event_type': eventType
                }, function(data) {
                    $(data).insertBefore($('#row_add_event_' + eventType));
                    $('#add_event_joined_date_' + eventType).val('');
                });                
            });
        });

        // Delete event
        $('.btn-delete-event').each(function() {
            $(this).on('click', function() {
                var eventId = $(this).attr('data-id');
                var ok = confirm("{{ __('Are you sure to delete ?') }}");

                if (ok == 1) {
                    $.post("/{{ config('auth.admin_dir') }}/users/events/" + eventId, {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        '_method': 'DELETE' 
                    }, function(data) {
                        data = data.trim();

                        if (data == eventId) {
                            $('#row_delete_event_' + eventId).remove();
                        }
                    });
                }  
            });
        });

        // Create new bank transfer payment
        $('.btn-create-bank-transfer-payment').each(function() {
            $(this).on('click', function() {
                var userId = $(this).attr('data-id');
                var userCode = $(this).attr('data-user-code');

                var ok = confirm(userCode + "に振込完了報告を作成しますか？");

                if (ok == 1) {
                    $('#hidden_user_id').val(userId);
                    $('#create_bank_transfer_payment_form').submit();
                }
            });
        });

        @if (old('choose_mailing_address') == 1)
            $('.font_company').show();
        @endif
        
        $('input[name="choose_mailing_address"]').on('change', function() {
            //alert('loz');
            if ($(this).val() == 1 || $(this).val() == '1') {
                //alert('test');
                $('.font_company').show();
            } else {
                $('.font_company').hide();
            }
        });
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
</script>
@endsection