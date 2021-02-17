@extends('layouts.admin.app')

@section('title', __('List common settings'))

@section('content')
<div class="col-lg-12 col-xs-12">
    <div class="box-content card white">
        <h4 class="box-title">
            {{ __('List common settings') }}
        </h4>

        @include('layouts.admin._flash_messages')

        <div class="card-content">
            <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('admin.commonSettings.store') }}">
                @csrf

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ __($commonSettings['image_width']['human_name']) }} <font color="red">※</font></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="image_width" name="image_width" value="{{ old('image_width', $commonSettings['image_width']['value']) }}">
                        @error('image_width')
                            <font color="red">{{ $message }}</font>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="" class="col-sm-3 control-label">{{ __($commonSettings['image_height']['human_name']) }} <font color="red">※</font></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="image_height" name="image_height" value="{{ old('image_height', $commonSettings['image_height']['value']) }}">
                        @error('image_height')
                            <font color="red">{{ $message }}</font>
                        @enderror
                    </div>
                </div>

                @if ($currentRole == 'dev')
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">
                            {{ __($commonSettings['admin_email']['human_name']) }}<br/>
                            <font color="red"><i>(Only for testing)</i></font> 
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="admin_email" name="admin_email" value="{{ old('admin_email', $commonSettings['admin_email']['value']) }}">
                            @error('admin_email')
                                <font color="red">{{ $message }}</font>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">
                            {{ __($commonSettings['test_emails']['human_name']) }}<br/>
                            <font color="red"><i>(Only for testing)</i></font>
                        </label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="test_emails" name="test_emails">{{ old('test_emails', $commonSettings['test_emails']['value']) }}</textarea>
                            @error('test_emails')
                                <font color="red">{{ $message }}</font>
                            @enderror
                        </div>
                    </div>

                    <!--
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">
                            {{ __('Range time when payment screen displayed') }}<br/>
                            <font color="red"><i>(Only for testing)</i></font>
                        </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="from_time_payment_screen_displayed" name="from_time_payment_screen_displayed" value="{{ old('from_time_payment_screen_displayed', $commonSettings['from_time_payment_screen_displayed']['value']) }}">
                            @error('from_time_payment_screen_displayed')
                                <font color="red">{{ $message }}</font>
                            @enderror
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="to_time_payment_screen_displayed" name="to_time_payment_screen_displayed" value="{{ old('to_time_payment_screen_displayed', $commonSettings['to_time_payment_screen_displayed']['value']) }}">
                            @error('to_time_payment_screen_displayed')
                                <font color="red">{{ $message }}</font>
                            @enderror
                        </div>
                    </div>
                    -->

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">
                            {{ __('Range time when create payment subscription') }}<br/>
                            <font color="red"><i>(Only for testing)</i></font>
                        </label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="from_time_create_payment_subscription" name="from_time_create_payment_subscription" value="{{ old('from_time_create_payment_subscription', $commonSettings['from_time_create_payment_subscription']['value']) }}">
                            @error('from_time_create_payment_subscription')
                                <font color="red">{{ $message }}</font>
                            @enderror
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="to_time_create_payment_subscription" name="to_time_create_payment_subscription" value="{{ old('to_time_create_payment_subscription', $commonSettings['to_time_create_payment_subscription']['value']) }}">
                            @error('to_time_create_payment_subscription')
                                <font color="red">{{ $message }}</font>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">
                            {{ __($commonSettings['send_emails_at_1st_september']['human_name']) }}<br/>
                            <font color="red"><i>(Only for testing, format: yyyy-mm-dd HH:ii:ss)</i></font>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="send_emails_at_1st_september" name="send_emails_at_1st_september" value="{{ old('send_emails_at_1st_september', $commonSettings['send_emails_at_1st_september']['value']) }}">
                            @error('send_emails_at_1st_september')
                                <font color="red">{{ $message }}</font>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">
                            {{ __($commonSettings['send_emails_at_15th_october']['human_name']) }}<br/>
                            <font color="red"><i>(Only for testing, format: yyyy-mm-dd HH:ii:ss)</i></font>
                        </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="send_emails_at_15th_october" name="send_emails_at_15th_october" value="{{ old('send_emails_at_15th_october', $commonSettings['send_emails_at_15th_october']['value']) }}">
                            @error('send_emails_at_15th_october')
                                <font color="red">{{ $message }}</font>
                            @enderror
                        </div>
                    </div>
                @endif

                <div class="form-group margin-bottom-0">
                    <div class="col-sm-offset-3 col-sm-9">
                
                        <button type="submit" id="save" class="btn btn-primary waves-effect waves-light">
                            <i class="fa fa-save"></i> {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            $('#from_time_payment_screen_displayed').datepicker({
                format: "yyyy-mm-dd",
                changeYear: true,
                changeMonth: true,
                yearRange: "1900:2030",
                defaultDate: "{{ date('Y-m-d') }}"
            }).on('changeDate', function(e) {
                $('#to_time_payment_screen_displayed').datepicker('setStartDate', e.date);
            });

            $('#to_time_payment_screen_displayed').datepicker({
                format: "yyyy-mm-dd",
                changeYear: true,
                changeMonth: true,
                yearRange: "1900:2030",
                defaultDate: "{{ date('Y-m-d') }}"
            }).on('changeDate', function(e) {
                $('#from_time_payment_screen_displayed').datepicker('setEndDate', e.date);
            });

            $('#from_time_create_payment_subscription').datepicker({
                format: "yyyy-mm-dd",
                changeYear: true,
                changeMonth: true,
                yearRange: "1900:2030",
                defaultDate: "{{ date('Y-m-d') }}"
            }).on('changeDate', function(e) {
                $('#to_time_create_payment_subscription').datepicker('setStartDate', e.date);
            });

            $('#to_time_create_payment_subscription').datepicker({
                format: "yyyy-mm-dd",
                changeYear: true,
                changeMonth: true,
                yearRange: "1900:2030",
                defaultDate: "{{ date('Y-m-d') }}"
            }).on('changeDate', function(e) {
                $('#from_time_create_payment_subscription').datepicker('setEndDate', e.date);
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