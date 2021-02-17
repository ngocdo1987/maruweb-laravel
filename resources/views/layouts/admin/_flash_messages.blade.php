@if (session('success'))
    <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                class="sr-only">{{ __('Close') }}</span></button>
        {{ session('success') }}
    </div>
@endif