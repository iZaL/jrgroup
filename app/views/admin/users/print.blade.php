@extends('admin.layouts.print')

{{-- Web site Title --}}
@section('title')
    Print Detail
@stop

{{-- Content --}}
@section('content')
<div class="row">
    <div class="col-md-12">
        @include('admin.users.detail')
    </div>
</div>
@stop