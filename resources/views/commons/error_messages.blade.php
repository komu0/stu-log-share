@if (count($errors) > 0)
    <ul class="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <li class="ml-4">{{ $error }}</li>
        @endforeach
    </ul>
@endif

@if (session('flash_message'))
    <div class="alert alert-success">
        {{session('flash_message')}}
    </div>
@endif

@if (session('flash_error_message'))
    <div class="alert alert-danger">
        {{session('flash_error_message')}}
    </div>
@endif