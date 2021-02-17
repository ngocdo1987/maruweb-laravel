@extends('layouts.admin.app')

@section('title', __('Add admin'))

@section('content')
    <div class="col-lg-12 col-xs-12">
        <div class="box-content card white">
            <h4 class="box-title">
                <a href="{{ route('admin.admins.index') }}?page={{ request()->page }}">{{ __('List admins') }}</a> > 
                {{ __('Add admin') }}
            </h4>

            @include('layouts.admin._flash_messages')

            <div class="card-content">
                <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('admin.admins.store') }}">
                    @csrf

                    <input type="hidden" name="page" id="page" value="{{ request()->page }}" />

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ __('Name') }} <font color="red">※</font></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                                <font color="red">{{ $message }}</font>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ __('Email Address') }} <font color="red">※</font></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <font color="red">{{ $message }}</font>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ __('Role') }} <font color="red">※</font></label>
                        <div class="col-sm-9">
                            <select name="role" id="role" class="form-control">
                                <option value="">--</option>
                                @foreach ($roleConfig as $role)
                                    @php
                                        $selected = $role == old('role') ? ' selected' : ''
                                    @endphp
                                    <option value="{{ $role }}"{{ $selected }}>{{ __(ucfirst($role)) }}</option>
                                @endforeach
                            </select>

                            @error('role')
                                <font color="red">{{ $message }}</font>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ __('Change password') }} <font color="red">※</font></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                            @error('password')
                                <font color="red">{{ $message }}</font>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ __('Confirm password') }} <font color="red">※</font></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="{{ old('confirm_password') }}">
                            @error('confirm_password')
                                <font color="red">{{ $message }}</font>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group margin-bottom-0">
                        <div class="col-sm-offset-3 col-sm-9">
                            <a href="javascript:void(0)" id="go_back" class="btn btn-warning waves-effect waves-light">
                                <i class="fa fa-chevron-circle-left"></i> {{ __('Return') }}
                            </a>
                    
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
            // Go back
            $('#go_back').on('click', function() {
                var back_url = "{{ route('admin.admins.index').'?page='.request()->page }}";

                var name = $('#name').val();
                var email = $('#email').val();
                var role = $('#role').val();
                var password = $('#password').val();
                var confirm_password = $('#confirm_password').val();

                if (name != '' || email != '' || role != '' || password != '' || confirm_password != '') {
                    var ok = confirm("{{ __('Would you like to return without saving what you filled out?') }}");

                    if (ok == 1) {
                        window.location = back_url;
                    }
                } else {
                    window.location = back_url;
                }
            });
        });
    </script>
@endsection