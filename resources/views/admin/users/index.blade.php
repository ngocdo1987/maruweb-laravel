@extends('layouts.admin.app')

@section('title', __('User management'))

@section('css')
<style>
    .tooltip1 {
        width: 30px;
      position: relative;
      display: inline-block;
      border-bottom: 1px dotted black;
    }
    
    .tooltip1 .tooltiptext {
      visibility: hidden;
      width: 240px;
      background-color: #555;
      color: #fff;
      text-align: left;
      border-radius: 6px;
      padding: 5px;
      position: absolute;
      z-index: 1;
      bottom: 125%;
      left: 50%;
      margin-left: -60px;
      opacity: 0;
      transition: opacity 0.3s;
    }
    
    .tooltip1 .tooltiptext::after {
      content: "";
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: #555 transparent transparent transparent;
    }
    
    .tooltip1:hover .tooltiptext {
      visibility: visible;
      opacity: 1;
    }
    #search_payment_confirmation{
        user-select: none;
    }
    </style>
@endsection

@section('content')
    @php 
        $checkoutService = new \App\Services\CheckoutService();
        //$totalSuccessfullyPayments = $checkoutService->totalSuccessfullyPaymentsByUserId(auth()->guard('web')->user()->id);
        //$showPaymentFormOrInvoice = $checkoutService->showPaymentFormOrInvoice(auth()->guard('web')->user()->id);
    @endphp

    <div class="col-xs-12">
        <div class="box-content">
            <h4 class="box-title">{{ __('User management') }}</h4>

            @include('layouts.admin._flash_messages')

            <div class="row">
                <div class="col-sm-12">

                    <a href="{{ route('admin.users.create') }}?user_type=0&page={{ request()->page }}" class="btn btn-primary waves-effect waves-light">
                        <i class="fa fa-plus-circle"></i> {{ __('Corporation partner member') }}
                    </a>

                    <a href="{{ route('admin.users.create') }}?user_type=1&page={{ request()->page }}" class="btn btn-primary waves-effect waves-light">
                        <i class="fa fa-plus-circle"></i> {{ __('General corporation member') }}
                    </a>

                    <a href="{{ route('admin.users.create') }}?user_type=2&page={{ request()->page }}" class="btn btn-primary waves-effect waves-light">
                        <i class="fa fa-plus-circle"></i> {{ __('General individual member') }}
                    </a>

                    <a href="{{ route('admin.users.create') }}?user_type=3&page={{ request()->page }}" class="btn btn-primary waves-effect waves-light">
                        <i class="fa fa-plus-circle"></i> {{ __('Supporting member') }}
                    </a>

                    <a href="{{ route('admin.users.export-csv').$searchParams }}" class="btn btn-warning waves-effect waves-light">
                        <i class="fa fa-download"></i> {{ __('CSV export') }}
                    </a>
                    <a href="{{ route('admin.users.export-csv')}}" class="btn btn-warning waves-effect waves-light">
                        <i class="fa fa-download"></i> {{ __('Export all data') }}
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>
                                <!-- ID -->
                            </td>
                            <td width="240">
                                <select id="search_user_type" class="form-control">
                                    <option value="">--</option>
                                    @foreach ($userTypeConfig as $k => $v)
                                        @php
                                            $search_user_type = request()->search_user_type != '' ? (int)request()->search_user_type : request()->search_user_type;
                                            $selected = $search_user_type === (int)$k ? ' selected' : '';
                                        @endphp
                                        <option value="{{ $k }}"{{ $selected }}>{{ __($v) }}</option>    
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="text" id="search_representative_name" class="form-control" value="{{ request()->search_representative_name }}" placeholder="{{ __('Representative name') }}" />
                            </td>
                            <td>
                                <input type="text" id="search_corporation_name" class="form-control" value="{{ request()->search_corporation_name }}" placeholder="{{ __('Corporation name') }}" />
                            </td>
                            <td>
                                <!-- Email -->
                            </td>
                            <td>
                                <!-- Last payment day -->
                            </td>
                            <td>
                                <input type="text" id="search_transfer_holder" class="form-control" value="{{ request()->search_transfer_holder }}" placeholder="{{ __('Transfer holder') }}" />
                            </td>
                            <td width="80">
                                <select id="search_display_on_list" class="form-control">
                                    <option value="">--</option>
                                    @foreach ($displayOnListConfig as $k => $v)
                                        @php
                                            $search_display_on_list = request()->search_display_on_list != '' ? (int)request()->search_display_on_list : request()->search_display_on_list;
                                            $selected = $search_display_on_list === (int)$k ? ' selected' : '';
                                        @endphp
                                        <option value="{{ $k }}"{{ $selected }}>{{ __($v) }}</option>    
                                    @endforeach
                                </select>
                            </td>
                            <td width="100">
                                <select id="search_status" class="form-control">
                                    <option value="">--</option>
                                    @foreach ($statusConfig as $k => $v)
                                        @php
                                            $search_status = request()->search_status != '' ? (int)request()->search_status : request()->search_status;
                                            $selected = $search_status === (int)$k ? ' selected' : '';
                                        @endphp
                                        <option value="{{ $k }}"{{ $selected }}>{{ __($v) }}</option>    
                                    @endforeach
                                </select>
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                <input {{ request()->search_payment_confirmation_button == 1 ? 'checked' : '' }} type="checkbox" id="search_payment_confirmation_button" value="1"> 
                                    <label id="search_payment_confirmation" for="search_payment_confirmation_button">{{ __('Payment confirmation') }}</label>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" id="search_multiple">
                                    <i class="ico ti-search"></i> {{ __('Search') }}
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>{{ __('Member type') }}</th>
                            <th>{{ __('Representative name') }}</th>
                            <th>{{ __('Corporation name') }}</th>
                            <th>{{ __('Email Address') }}</th>
                            <th>{{ __('Last payment date') }}</th>
                            <th>{{ __('Transfer holder') }}</th>
                            <th>★</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Admin note') }}</th>
                            <th></th>
                            <th>{{ __('Confirm payment') }}</th>
                            <th></th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        @if (count($users) > 0)
                            @php 
                                $rememberUserId = 0;
                            @endphp 

                            @foreach ($users as $user)
                                @if ($user->id != $rememberUserId)
                                    @php 
                                        $showPaymentFormOrInvoice = $checkoutService->showPaymentFormOrInvoice($user->id);
                                        $showPaymentForm = $showPaymentFormOrInvoice['show_payment_form'];
                                        $bankTransferAndStatus0 = $user->payment_method == 1 && $user->payment_status == 0;
                                        $bankTransferAndStatus1 = $user->payment_method == 1 && $user->payment_status == 1;
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.users.edit', $user->id).'?payment_id='.$user->payment_id.'&page='.request()->page }}">
                                                <b>USE{{ str_pad($user->id, 7, '0', STR_PAD_LEFT) }}</b>
                                            </a>
                                        </td>
                                        <td style="width: 8%">{{ isset($userTypeConfig[$user->user_type]) ? __($userTypeConfig[$user->user_type]) : '' }}</td>
                                        <td>
                                            @if (in_array($user->user_type, [0, 1, 3]))
                                                {{ $user->association_notification_representative_fname.' '.$user->association_notification_representative_lname }}
                                            @else 
                                                {{ $user->fname.' '.$user->lname }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (in_array($user->user_type, [0, 1, 3]))
                                                {{ $user->corporation_name }}
                                            @else 
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td id="td_payment_created_at_{{ $user->payment_id }}">
                                            {{ $user->settlement_confirmation_date }}
                                        </td>
                                        <td>
                                            @if ($user->payment_method == 1)
                                                @if ($user->transfer_holder != $user->corporation_name)
                                                    {{ $user->transfer_holder }}    
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->display_on_list == 1)
                                                ★
                                            @endif
                                        </td>
                                        <td>
                                            {{ isset($statusConfig[$user->status]) ? __($statusConfig[$user->status]) : '' }}
                                        </td>
                                        <td class="td_admin_note" data-id="{{ $user->id }}" data-payment-id="{{ $user->payment_id }}">
                                            
                                            @if ($user->admin_note != '')
                                                <div class="tooltip1">アリ
                                                    <span class="tooltiptext">{!! nl2br($user->admin_note) !!}</span>
                                                </div>
                                            @endif

                                        </td>

                                        <td style="width: 6%" id="td_create_bank_transfer_payment_{{ $user->payment_id }}">
                                            <button style="{!! $showPaymentForm == true ? '' : 'display:none;' !!}" type="button" class="btn btn-xs waves-effect waves-light btn-create-bank-transfer-payment" data-id="{{ $user->id }}" data-user-code="USE{{ str_pad($user->id, 7, '0', STR_PAD_LEFT) }}">
                                                <span>{{ __('Create bank transfer payment') }}</span>
                                            </button>
                                        </td>

                                        <td style="width: 6%" id="td_confirm_payment_{{ $user->payment_id }}">
                                            <button style="{!! $bankTransferAndStatus0 == true ? '' : 'display:none;' !!}" type="button" class="btn btn-xs btn-success btn-payment" id="btn-payment-{{ $user->payment_id }}" data-id="{{ $user->payment_id }}">
                                                <span>{{ __('Confirm payment') }}</span>
                                            </button>
                                        </td>

                                        <td id="td_cancel_payment_{{ $user->payment_id }}" style="{!! $bankTransferAndStatus0 == true ? '' : 'display:none;' !!}">
                                            <button type="button" class="btn btn-xs btn-danger btn-cancel-payment" id="btn-payment-{{ $user->payment_id }}" data-id="{{ $user->payment_id }}">
                                                <span>{{ __('Cancel confirmation') }}</span>
                                            </button>
                                        </td>

                                        <td id="td_cancel_confirm_payment_{{ $user->payment_id }}" style="{!! $bankTransferAndStatus1 == true ? '' : 'display:none;' !!}">
                                            <button type="button" class="btn btn-xs btn-danger btn-cancel-confirm-payment" id="btn-payment-{{ $user->payment_id }}" data-id="{{ $user->payment_id }}" data-user-code="USE{{ str_pad($user->id, 7, '0', STR_PAD_LEFT) }}">
                                                <span>{{ __('Cancel confirmed payment') }}</span>
                                            </button>
                                        </td>
                                    </tr>
                                @endif

                                @php 
                                    $rememberUserId = $user->id;
                                @endphp
                            @endforeach
                        @else 
                            <tr>
                                <td colspan="12">
                                    <center><font color="red">{{ __('Records not found') }}</font></center>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{ $users->appends(request()->input())->links() }}
        </div>
    </div>

    <form id="create_bank_transfer_payment_form" method="POST" action="{{ route('admin.users.create-bank-transfer-payment') }}">
        @csrf

        <input type="hidden" name="hidden_user_id" id="hidden_user_id" value="" />
        <input type="hidden" name="from" value="index" />
    </form>
@endsection

@section('js')
    <script type="text/javascript" src="/js/lib/validate.js"></script>
    <script type="text/javascript" src="/js/lib/moment.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#search_multiple').on('click', function() {
                var search_user_type = $('#search_user_type').val();
                var search_representative_name = $('#search_representative_name').val();
                var search_corporation_name = $('#search_corporation_name').val();
                var search_transfer_holder = $('#search_transfer_holder').val();
                var search_status = $('#search_status').val();
                var search_display_on_list = $('#search_display_on_list').val();
                var search_payment_confirmation_button = $('#search_payment_confirmation_button').is(':checked') ? 1 : 0;

                if (search_user_type == '' && search_representative_name == '' && search_corporation_name == '' && search_transfer_holder == '' && search_status == '' && search_display_on_list == '' && search_payment_confirmation_button == '') {
                    window.location = '{{ route('admin.users.index') }}';
                } else {
                    window.location = '{{ route('admin.users.index') }}?search_user_type=' + search_user_type + '&search_representative_name=' + search_representative_name + '&search_corporation_name=' + search_corporation_name + '&search_transfer_holder=' + search_transfer_holder + '&search_status=' + search_status + '&search_display_on_list=' + search_display_on_list + '&search_payment_confirmation_button=' + search_payment_confirmation_button;
                }
            });


            // Change payment status to success
            $('.btn-payment').each(function() {
                $(this).on('click', function() {
                    var paymentId = $(this).attr('data-id');

                    var ok = confirm("{{ __('Would you like to send a payment confirmation email to this user?') }}");

                    if (ok == 1) {
                        var paymentDate = prompt("{{ __('Please enter payment date (format yyyy-mm-dd)') }}", "{{ date('Y-m-d H:i:s') }}");

                        var formats = [
                            moment.ISO_8601,
                            "MM/DD/YYYY  :)  HH*mm*ss"
                        ];
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
                                    // Hide confirm payment button
                                    $('#td_confirm_payment_' + paymentId + ' button').hide();

                                    // Hide cancel payment td
                                    $('#td_cancel_payment_' + paymentId).hide();

                                    // Show cancel confirm payment td
                                    $('#td_cancel_confirm_payment_' + paymentId).show();

                                    // Hide create bank transfer payment button
                                    $('#td_create_bank_transfer_payment_' + paymentId + ' button').hide();

                                    // Update payment date
                                    $('#td_payment_created_at_' + paymentId).html(paymentDate);
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
                                // Hide confirm payment button
                                $('#td_confirm_payment_' + paymentId + ' button').hide();

                                // Hide cancel payment td
                                $('#td_cancel_payment_' + paymentId).hide();

                                //$('#td_create_bank_transfer_payment_' + paymentId).html('');
                            }
                        });
                    }
                });
            });

            // Cancel confirm
            $('.btn-cancel-confirm-payment').each(function() {
                $(this).on('click', function() {
                    var paymentId = $(this).attr('data-id');
                    var userCode = $(this).attr('data-user-code');

                    var ok = confirm("USER" + userCode + "に入金確認を取消しますか？");

                    if (ok == 1) {
                        $.post('/{{ config('auth.admin_dir') }}/payments/' + paymentId, {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            '_method': 'PATCH',
                            'id': paymentId,
                            'status': 0
                        }, function(data) {
                            data = data.trim();
                            if (data == paymentId) {
                                // Show confirm payment button
                                $('#td_confirm_payment_' + paymentId + ' button').show();

                                // Show cancel payment td
                                $('#td_cancel_payment_' + paymentId).show();

                                // Hide cancel confirm payment td
                                $('#td_cancel_confirm_payment_' + paymentId).hide();

                                //$('#td_create_bank_transfer_payment_' + paymentId).html('');
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

            // Admin note
            $('td.td_admin_note').on('mouseover', function() {
                var userId = $(this).attr('data-id');
                var paymentId = $(this).attr('data-payment-id');

                $('#hide_note_' + userId + paymentId).hide();
                $('#show_note_' + userId + paymentId).show();
            });
            $('td.td_admin_note').on('mouseout', function() {
                var userId = $(this).attr('data-id');
                var paymentId = $(this).attr('data-payment-id');

                $('#hide_note_' + userId + paymentId).show();
                $('#show_note_' + userId + paymentId).hide();
            });
            
        });
    </script>    
@endsection