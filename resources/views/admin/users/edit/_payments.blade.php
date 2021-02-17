<div class="form-group">
    <label for="" class="col-sm-3 control-label"><h4>{{ __('Payments history') }}</h4></label>
    <div class="col-sm-9">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('Payment ID') }}</th>
                        <th>{{ __('Datetime') }}</th>
                        <th>{{ __('Payment method (list payments)') }}</th>
                        <th>{{ __('Transfer holder') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($payments) > 0)
                        @foreach ($payments as $payment)
                            <tr>
                                <td><b>PAY{{ str_pad($payment->id, 7, '0', STR_PAD_LEFT) }}</b></td>
                                <td>{{ $payment->created_at }}</td>
                                <td>{{ isset($paymentMethodConfig[$payment->payment_method]) ? __($paymentMethodConfig[$payment->payment_method]) : '' }}</td>
                                <td>
                                    @if ($payment->payment_method == 1)
                                        @if ($payment->transfer_holder != $user->corporation_name)
                                            {{ $payment->transfer_holder }}    
                                        @endif
                                    @endif
                                </td>
                                <td id="td_status_{{ $payment->id }}">
                                    {{ isset($statusConfig[$payment->status]) ? __($statusConfig[$payment->status]) : '' }}
                                </td>
                                <td>
                                    @if ($payment->payment_method == 1 && $payment->status == 0)
                                        <button type="button" class="btn btn-xs btn-success btn-payment" id="btn-payment-bis-{{ $payment->id }}" data-id="{{ $payment->id }}">
                                            <span>{{ __('Confirm payment') }}</span>
                                        </button>

                                        <button type="button" class="btn btn-xs btn-danger btn-cancel-payment" id="btn-cancel-payment-bis-{{ $payment->id }}" data-id="{{ $payment->id }}">
                                            <span>{{ __('Cancel confirmation') }}</span>
                                        </button>
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
    </div>
</div>

