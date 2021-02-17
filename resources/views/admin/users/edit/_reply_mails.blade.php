<div class="form-group">
    <label for="" class="col-sm-3 control-label"><h4>{{ __('Email transmission history') }}</h4></label>
    <div class="col-sm-9">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{ __('Send datetime') }}</th>
                        <th>{{ __('Destination') }}</th>
                        <th>{{ __('Member name') }}</th>
                        <th>{{ __('Subject') }}</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @if (count($replyMails) > 0)
                        @foreach ($replyMails as $replyMail)
                            <tr>
                                <td>{{ $replyMail->created_at }}</td>
                                <td>{{ $replyMail->email }}</td>
                                <td>{{ $replyMail->name }}</td>
                                <td>{{ $replyMail->subject }}</td>
                            </tr>
                        @endforeach    
                    @else 
                        <tr>
                            <td colspan="4">
                                <center><font color="red">{{ __('Records not found') }}</font></center>
                            </td>
                        </tr>
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

