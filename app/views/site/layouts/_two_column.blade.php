<div class="col-md-9 col-sm-9">
    @section('content')
    @show
</div>

<div class="col-md-3 col-sm-3">
    @section('sidebar')
        @include('site.events._latest')
        @include('site.blogs._latest')
        @include('site.partials.newsletter')
    @show
</div>