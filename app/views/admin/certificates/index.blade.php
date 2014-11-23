@extends('admin.master')

{{-- Content --}}
@section('content')
<style>
    .panel-body { padding:0px; }
    .panel-body table tr td { padding-left: 15px }
    .panel-body .table {margin-bottom: 0px; }
</style>
    <div class="row" style="margin-top: 80px;">
        <div class="col-sm-3 col-md-3">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-th">
                            </span>Certificate Types</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <a href="{{ action('AdminCertificateTypesController@index') }}">View</a> <span class="label label-success"> All</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{ action('AdminCertificateTypesController@create') }}">Add New</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{ action('AdminCertificateTypesController@index') }}">Edit</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-tag">
                            </span>Certificate Category</a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <a href="{{ action('AdminCertificateMetasController@index') }}">View</a> <span class="label label-success"> All</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{ action('AdminCertificateMetasController@create') }}">Add New</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{ action('AdminCertificateMetasController@index') }}">Edit</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="glyphicon glyphicon-plus">
                            </span>Certificate Options</a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <a href="{{ action('AdminCertificateOptionsController@index') }}">View</a> <span class="label label-success"> All</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{ action('AdminCertificateOptionTypesController@index') }}">Edit Prices</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{ action('AdminCertificateOptionsController@create') }}">Add New</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{ action('AdminCertificateOptionsController@index') }}">Edit</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-9 col-md-9">
            <btn class="btn btn-default"><a href="{{ action('AdminCertificateRequestsController@create')}}">Request a Certificate </a> </btn>
            <h1> Certificate Requests </h1>
            <table class="well table table-hover">


                <thead>
                <tr>
                    <th>CertificateType</th>
                    <th class="text-center">User</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Total</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Details</th>
                    <th class="text-center">Action</th>
                    <th class="text-center">Requested</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($requests as $request)
                    <tr>
                        <td class="col-sm-8 col-md-4">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#">{{ $request->type->name }}</a></h4>
                                </div>
                            </div>
                        </td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                            {{ $request->user->username }}
                        </td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                            {{ $request->quantity }}
                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong>
                            {{ $request->amount }} KD
                        </strong></td>
                        <td>
                            @if(count($request->status))
                            <a href="{{ URL::action('AdminCertificateStatusesController@edit',  array($request->status->id), array('class' => 'btn btn-info')) }}">

                                @if(count($request->status))
                                {{ $request->status->status }} -
                                @endif
                                Edit</a>
                            @endif
                        </td>
                        <td><a href="{{ URL::action('AdminCertificateRequestsController@show',  array($request->id), array('class' => 'btn btn-info')) }}">View</a></td>
                        <td>
                            {{ Form::open(array('method' => 'DELETE', 'action' => array('AdminCertificateStatusesController@destroy', $request->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) }}
                            {{ Form::close() }}
                        </td>
                        <td class="col-sm-1 col-md-2">
                            {{ $request->created_at->diffForHumans() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@stop