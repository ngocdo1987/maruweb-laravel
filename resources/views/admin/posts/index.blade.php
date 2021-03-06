@extends('layouts.admin.app')

@section('title', __('List posts'))

@section('content')
    <div class="col-xs-12">
        <div class="box-content">
            <h4 class="box-title">{{ __('List posts') }}</h4>

            @include('layouts.admin._flash_messages')

            <div class="row">
                <div class="col-sm-12">
                    <a href="{{ route('admin.posts.create') }}?page={{ request()->page }}" class="btn btn-primary waves-effect waves-light">
                        <i class="fa fa-plus-circle"></i> {{ __('Create new post') }}
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td></td>
                            <td>
                                <input type="text" id="search_name" class="form-control" value="{{ request()->search_name }}" placeholder="" />
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" id="search_multiple">
                                    <i class="ico ti-search"></i> {{ __('Search') }}
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($posts) > 0)
                            @foreach ($posts as $post)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.posts.edit', $post->id) }}">
                                            <b>DUM{{ str_pad($post->id, 7, '0', STR_PAD_LEFT) }}</b>
                                        </a>
                                        
                                    </td>
                                    <td></td>
                                    <td>
                                        <a href="{{ route('admin.posts.edit', $post->id) }}?page={{ request()->page }}" class="btn btn-primary btn-circle btn-xs waves-effect waves-light">
                                            <i class="ico fa fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.posts.destroy', $post->id) }}" id="delete_post_{{ $post->id }}" method="POST" style="display: inline">
                                            @csrf
                                            @method('DELETE')

                                            <input type="hidden" name="page" value="{{ request()->page }}" />

                                            <a href="javascript:void(0)" onclick="event.preventDefault(); if (confirm('{{ __('Are you sure to delete ?') }}')){
                                                $('#delete_post_{{ $post->id }}').submit();
                                            }" class="btn btn-danger btn-circle btn-xs waves-effect waves-light delete_post">
                                                <i class="ico fa fa-trash"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else 
                            <tr>
                                <td colspan="3">
                                    <center><font color="red">{{ __('Records not found') }}</font></center>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{ $posts->appends(request()->input())->links() }}
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(function() {
            $('#search_multiple').on('click', function() {
                var search_name = $('#search_name').val();

                if (search_name == '') {
                    window.location = '{{ route('admin.posts.index') }}';
                } else {
                    window.location = '{{ route('admin.posts.index') }}?search_name=' + search_name;
                }
            });
        });
    </script>    
@endsection