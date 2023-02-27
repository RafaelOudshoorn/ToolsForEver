@if(session()->has('success'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
@endif
@if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
@endif
        <strong>{{ $slot }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>