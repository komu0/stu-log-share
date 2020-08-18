@if (count($errors) > 0)
    <ul class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <li class="ml-4">{{ $error }}</li>
        @endforeach
    </ul>
@endif

@if (session('flash_message'))
    <div class="alert alert-success">
        {!!nl2br(session('flash_message')) !!}
    </div>
@endif

@if (session('flash_error_message'))
    <li class="alert alert-danger"  role="alert">
        {{session('flash_error_message')}}
    </li>
@endif