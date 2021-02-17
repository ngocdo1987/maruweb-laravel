@extends('layouts.admin.app')

@section('title', __('Admin Dashboard'))

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    {{ __('Admin logged in!') }}
@endsection
