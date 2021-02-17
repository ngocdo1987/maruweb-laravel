@extends('layouts.admin.app')

@section('title', __('Dashboard'))

@section('content')
<div class="" style="height:100%">
    <div class="row small-spacing">
        <div class="col-lg-2 col-xs-12">
        </div>
        <div class="col-lg-4 col-xs-12">
            <div class="box-content">
                <h4 class="box-title text-info">{{ __('User Bank transfer Unsupported number') }}</h4>
            
                <!-- /.box-title -->
                <div class="content widget-stat">
                    <!-- /#traffic-sparkline-chart-1 -->
                    <div class="right-content">
                        <h2 class="counter text-info">-</h2>
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
                <h4 class="box-title text-success">{{ __('Inquiry management unsupported number') }}</h4>

                <!-- /.box-title -->
                <div class="content widget-stat">
                    <div class="right-content">
                        <h2 class="counter text-danger">-</h2>
                    </div>
                    <!-- .right-content -->
                </div>
                <!-- /.content widget-stat -->
            </div>
            <!-- /.box-content -->
        </div>
    </div>
    <!-- /.row .small-spacing -->		
    
</div>
@endsection