@extends('layouts.admin.app')

@section('title', __($userTypeConfig[request()->user_type]).__('Add'))

@section('content')
    <div class="col-lg-12 col-xs-12">
        <div class="box-content card white">
            <h4 class="box-title">
                <a href="{{ route('admin.users.index') }}">{{ __('User management') }}</a> > 
                {{ __($userTypeConfig[request()->user_type]).__('Add') }}
            </h4>

            @include('layouts.admin._flash_messages')

            <div class="card-content">
                <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('admin.users.store') }}">
                    @csrf

                    <input type="hidden" name="page" id="page" value="{{ request()->page }}" />
                    <input type="hidden" name="user_type" id="user_type" value="{{ $userType }}" />

                    <div class="form-group">
                        <label for="" class="col-sm-10 control-label"></label>
                        <label class="col-sm-2 control-label">
                            <select name="display_on_list" id="display_on_list" class="form-control">
                                <option value="">--</option>
                                @foreach ($displayOnListConfig as $k => $v)
                                    @php
                                        $selected = $k == old('display_on_list') ? ' selected' : ''
                                    @endphp
                                    <option value="{{ $k }}"{{ $selected }}>{{ $v }}</option>
                                @endforeach
                            </select>
                            @error('display_on_list')
                                <font color="red">{{ $message }}</font>
                            @enderror
                        </label>
                    </div>
                    
                    @include('admin.users.create.create_'.$userType)
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript" src="/js/jquery.jpostal.js"></script>

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