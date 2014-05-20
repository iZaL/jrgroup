@extends('admin.layouts.default')

{{-- Content --}}
@section('content')
<style>
    .glyphicon { margin-right:10px; }
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
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-user">
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
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span class="glyphicon glyphicon-file">
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
            <div class="well">
                <btn class="btn btn-default"><a href="{{ action('AdminCertificateRequestsController@create')}}">Request a Certificate </a> </btn>
                <h1> Certificate Requests </h1>

                @if ($requests->count())
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Certificate Type</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($requests as $request)
                    <tr>
                        <td>{{ $request->type->name }}</a></td>
                        <td>{{ $request->user->username }}</td>

                        <td>{{ (float)round($request->amount) }} KD</td>
                        <td>
                            @if(count($request->status))
                                {{ $request->status->status }}
                            @endif
                        </td>
                        <td>Requested {{ $request->getHumanCreatedAtAttribute() }} </td>

                        <td>
                            @if(count($request->status))
                                <a href="{{ URL::action('AdminCertificateStatusesController@edit',  array($request->status->id), array('class' => 'btn btn-info')) }}">Edit</a>
                            @endif
                        </td>
                        <td><a href="{{ URL::action('AdminCertificateRequestsController@edit',  array($request->id), array('class' => 'btn btn-info')) }}">Edit Request</a></td>
                        <td>
                            {{ Form::open(array('method' => 'DELETE', 'action' => array('AdminCertificateStatusesController@destroy', $request->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                There are no Certificate Requests.
                @endif

                @stop

            </div>
        </div>
    </div>
@stop