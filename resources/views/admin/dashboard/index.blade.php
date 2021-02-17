@extends('layouts.admin.app')

@section('title', __('Dashboard'))

@section('content')
<div class="" style="height:100%">
    <div class="row small-spacing">
        <div class="col-lg-2 col-xs-12">
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="box-content">
               <a href="{{ route('admin.payments.index', ['search_status' => 0, 'search_payment_method' => 1, 'search_payment_confirmation_button' => 1]) }}">
                <h4 class="box-title text-info">{{ __('User Bank transfer Unsupported number') }}</h4>
               </a>
                <!-- /.box-title -->
                <div class="content widget-stat">
                    <!-- /#traffic-sparkline-chart-1 -->
                    <div class="right-content">
                        <a href="{{ route('admin.payments.index', ['search_status' => 0, 'search_payment_method' => 1, 'search_payment_confirmation_button' => 1]) }}">
                            <h2 class="counter text-info">{{ $user_transfer->count }}</h2>
                        </a>
                        <!-- /.counter -->
                        {{-- <p class="text text-info">Some text here</p> --}}
                        <!-- /.text -->
                    </div>
                    <!-- .right-content -->
                </div>
                <!-- /.content widget-stat -->
            </div>
            <!-- /.box-content -->
        </div>
        <!-- /.col-lg-4 col-xs-12 -->
        <!-- /.col-lg-4 col-xs-12 -->

        <div class="col-lg-4 col-xs-12">
            <div class="box-content">
                <a href="{{ route('admin.contacts.index', ['status' => 0]) }}">
                    <h4 class="box-title text-success">{{ __('Inquiry management unsupported number') }}</h4>
                </a>
                <!-- /.box-title -->
                <div class="content widget-stat">
                    <div class="right-content">
                       <a href="{{ route('admin.contacts.index', ['status' => 0]) }}"> <h2 class="counter text-danger">{{ $contact }} </h2></a>
                        <!-- /.counter -->
                        {{-- <p class="text text-danger">Some text here</p> --}}
                        <!-- /.text -->
                    </div>
                    <!-- .right-content -->
                </div>
                <!-- /.content widget-stat -->
            </div>
            <!-- /.box-content -->
        </div>
    </div>
    <!-- /.row .small-spacing -->		
    {{-- <footer class="footer">
        <ul class="list-inline">
            <li>2016 © NinjaAdmin.</li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Terms</a></li>
            <li><a href="#">Help</a></li>
        </ul>
    </footer> --}}
</div>
@endsection