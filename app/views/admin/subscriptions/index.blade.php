@extends('admin.master')

{{-- Content --}}
@section('content')
<div class="row ">
    <div class="col-md-12 ">
        <!-- Nav tabs category -->
        <ul class="nav nav-tabs faq-cat-tabs">
            <li class="{{ $type == 'event' ? 'active' :'' }}">
                <a href="{{ action('AdminSubscriptionsController@index', ['type'=>'event']) }}">Event Subscriptions&nbsp;</a>
            </li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content faq-cat-content" style="margin-top:20px;">
            <div class="tab-pane active in fade " id="event-tab">

                <div class="row">
                    <div class="col-md-2">
                        <nav class="nav-sidebar">
                            <ul class="nav tabs">
                                <li class="{{ !isset($_GET['status']) ? 'active':'' }} ">
                                    <a href="{{ action('AdminSubscriptionsController@index') }}">All</a></li>
                                <li class="{{ (isset($_GET['status']) && $_GET['status'] == 'confirmed' ) ? 'active' :'' }}">
                                    <a href="{{ action('AdminSubscriptionsController@index', ['type'=>'event','status'=>'confirmed']) }}">Confirmed</a>
                                </li>
                                <li class="{{ (isset($_GET['status']) && $_GET['status'] == 'waiting' ) ? 'active' :'' }}">
                                    <a href="{{ action('AdminSubscriptionsController@index', ['type'=>'event','status'=>'waiting']) }}">Waiting</a>
                                </li>
                                <li class="{{ (isset($_GET['status']) && $_GET['status'] == 'approved' ) ? 'active' :''  }}">
                                    <a href="{{ action('AdminSubscriptionsController@index', ['type'=>'event','status'=>'approved']) }}">Approved</a>
                                </li>
                                <li class="{{ (isset($_GET['status']) && $_GET['status'] == 'pending' ) ? 'active' :'' }}">
                                    <a href="{{ action('AdminSubscriptionsController@index', ['type'=>'event','status'=>'pending']) }}">Pending</a>
                                </li>
                                <li class="{{ (isset($_GET['status']) && $_GET['status'] == 'cancelled' ) ? 'active' :'' }}">
                                    <a href="{{ action('AdminSubscriptionsController@index', ['type'=>'event','status'=>'cancelled']) }}">Cancelled</a>
                                </li>
                                <li class="{{ (isset($_GET['status']) && $_GET['status'] == 'rejected' ) ? 'active' :'' }}">
                                    <a href="{{ action('AdminSubscriptionsController@index', ['type'=>'event','status'=>'rejected']) }}">Rejected</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-10">
                        <div class="tab-content">
                            <div class="tab-pane active text-style" id="tab-single-1">
                                @if ($subscriptions->count())
                                <table class="datatable table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th>Subscribed on</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($subscriptions as $subscription)
                                    <tr>
                                        <td>
                                            <a href="{{action('AdminEventsController@getRequests',$subscription->event->id) }}">{{ $subscription->event->title }}</a>
                                        </td>
                                        <td><a href="{{ action('AdminUsersController@show',$subscription->user->id) }}">{{ $subscription->user->username }}</a></td>
                                        <td><a href="{{ URL::action('AdminSubscriptionsController@edit',$subscription->id)}}">{{ $subscription->status }}</a></td>
                                        <td>{{ $subscription->formattedCreated() }}</td>
                                        <td>
                                            {{ Form::open(array('method' => 'DELETE', 'action' => array('AdminSubscriptionsController@destroy', $subscription->id))) }}
                                            <a class="btn btn-xs btn-info" href="{{ URL::action('AdminSubscriptionsController@edit',  array($subscription->id)) }}">Edit</a>
                                            {{ Form::submit('Delete', array('class' => 'btn btn-xs btn-danger')) }}
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @else
                                No Subscriptions Yet
                                @endif

                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@stop


