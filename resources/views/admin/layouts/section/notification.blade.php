@if(session('success'))
    <div class="alert alert-success alert-bordered alert-dismissable fade show">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-bordered alert-dismissable fade show">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        {{ session('error') }}
    </div>
@endif


@if(session('warning'))
    <div class="alert alert-warning alert-bordered alert-dismissable fade show">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        {{ session('warning') }}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info alert-bordered alert-dismissable fade show">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        {{ session('info') }}
    </div>
@endif
