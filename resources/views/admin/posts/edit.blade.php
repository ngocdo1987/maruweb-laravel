@extends('layouts.admin.app')

@section('title', __('Edit post'))

@section('content')
    <div class="col-lg-12 col-xs-12">
        <div class="box-content card white">
            <h4 class="box-title">
                <a href="{{ route('admin.posts.index') }}?page={{ request()->page }}">{{ __('List posts') }}</a> > 
                {{ __('Edit post') }}
            </h4>

            @include('layouts.admin._flash_messages')

            <div class="card-content">
                <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ route('admin.posts.update', $post->id) }}">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="id" value="{{ $post->id }}" />
                    <input type="hidden" name="page" id="page" value="{{ request()->page }}" />

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ __('ID') }}</label>
                        <label for="" class="col-sm-9 control-label" style="text-align: left;">
                            DUM{{ str_pad($post->id, 7, '0', STR_PAD_LEFT) }}
                        </label>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">{{ __('Name') }} <font color="red">※</font></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $post->name) }}">
                            @error('name')
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
        var current_name = "{{ $post->name }}";

        // Go back
        $('#go_back').on('click', function() {
            var back_url = "{{ route('admin.posts.index').'?page='.request()->page }}";

            var name = $('#name').val();

            if (name != current_name) {
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