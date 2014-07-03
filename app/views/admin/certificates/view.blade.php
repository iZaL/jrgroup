@extends('admin.layouts.default')

{{-- Content --}}
@section('content')
<style>
    .panel-body { padding:0px; }
    .panel-body table tr td { padding-left: 15px }
    .panel-body .table {margin-bottom: 0px; }
</style>
    <div class="row" style="margin-top: 80px;">
        <div class="col-md-12">
            <table class="well table table-hover">
                <thead>
                <tr>
                    <th>Certificate Type</th>
                    <th class="text-center">User</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Status</th>
                    <th> Date </th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-8 col-md-4">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="#">{{ $request->type->name }}</a></h4>
                                </div>
                            </div>
                        </td>
                        <td class="col-sm-1 col-md-2" style="text-align: center">
                            {{ $request->user->username }}
                        </td>
                        <td class="col-sm-1 col-md-2" style="text-align: center">
                            {{ $request->quantity }}
                        </td>
                        <td class="col-sm-1 col-md-2 text-center"><strong>
                                @if(count($request->status))
                                {{ $request->status->status }}
                                @endif
                        </strong></td>
                        <td class="col-sm-1 col-md-2">
                             {{ $request->created_at->format('Y-m-d') }}
                        </td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>{{ $request->type->name }}</h5></td>
                        <td ><h5><strong>{{ $request->type->price }} KD</strong></h5></td>
                    </tr>
                    @foreach($request->requestOption as $requestOption)

                        @if(isset($requestOption->id) && ($requestOption->price > 0))
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td><h5>{{ $requestOption->option->name }}</h5></td>
                                <?php
                                    $optionPrice = $requestOption->getPriceSingle($request->type->id,$requestOption->option_id);
                                ?>
                                <td ><h5><strong>{{ $optionPrice->price }} KD</strong></h5></td>
                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td><h3><strong>{{ $request->amount }} KD</strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                            <a href="{{  URL::action('AdminCertificateRequestsController@printDetail',$request->id ) }}" class=" btn  btn-default"><i class="glyphicon glyphicon-print"></i> Print</a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
@stop