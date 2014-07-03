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
                    <th>Detail</th>
                    <th>Certificate Type</th>
                    <th>User</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Status</th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($requests as $request)
                    <tr>
                        <td class="col-sm-1 col-md-1"><strong>Detail</strong></td>

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
                                @if(count($request->status))
                                {{ $request->status->status }}
                                @endif
                        </strong></td>
                        <td class="col-sm-1 col-md-2">
                            Requested {{ $request->getHumanCreatedAtAttribute() }}
                        </td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>{{ $request->type->name }}</h5></td>
                        <td class="text-right"><h5><strong>{{ $request->type->price }} KD</strong></h5></td>
                    </tr>
                    @foreach($request->requestOption as $requestOption)
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>{{ $requestOption->option->name }}</h5></td>
                        <?php
                            $optionPrice = $requestOption->getPriceSingle($request->type->id,$requestOption->option_id);
                        ?>
                        <td class="text-right"><h5><strong>{{ $optionPrice->price }} KD</strong></h5></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong>{{ $request->amount }} KD</strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                            <button type="button" class="btn btn-danger">
                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@stop