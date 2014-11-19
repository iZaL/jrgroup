@extends('admin.master')

@section('content')
<p class="btn btn-default">{{ link_to_action('AdminEventsController@create', 'Add New Event') }}</p>

<div class="row " style="margin-top: 20px;">
    <div class="col-md-12 ">

        @if ($events->count())
        <table cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
            <thead>
            <tr>
                <td>Event ID</td>
                <th>Title</th>
                <th>Start Date</th>
                <th>Event Settings</th>
                <th>Total Seats</th>
                <th>Available Seats</th>
                <th>Event Type</th>
                <th>Add/Edit Photos</th>
                <th>Actions</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($events as $event)
                @if(count($event->setting))
                    <tr>
                        <td>{{{ $event->id }}}</td>
                        <td>{{{ $event->title }}}</td>
                        <td>{{{ $event->date_start }}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                              <a href="{{ URL::action('AdminEventsController@getDetails',$event->id)}}" class="btn btn-default">Details</a>
                              <a href="{{ URL::action('AdminSettingsController@edit',$event->setting->id)}}" class="btn btn-default">Settings</a>
                              <a href="{{ URL::action('AdminSettingsController@getAddRoom', $event->setting->id) }}" class="btn btn-default">Online Room Number</a>
                              <a href="{{action('AdminEventsController@getSubscriptions',$event->id) }}" class="btn btn-default">Subscriptions</a>
                            </div>
                        </td>
                        <td> {{ $event->total_seats }}</td>
                        <td> {{ $event->available_seats }}</td>
                        <td>
                             {{ $event->isFreeEvent() ? 'Free' : 'Paid' }}
                        </td>
                        <td><a href="{{ URL::action('AdminPhotosController@create', ['imageable_type' => $event->setting->settingable_type, 'imageable_id' => $event->setting->settingable_id]) }}" class="btn btn-xs btn-success">Add Photos</a></td>
                        <td>
                            {{ Form::open(array('method' => 'DELETE', 'action' => array('AdminEventsController@destroy', $event->id))) }}
                            <a href="{{ URL::action('AdminEventsController@edit', array($event->id)) }}" class="btn btn-xs btn-warning">Edit</a>
                                {{ Form::submit('Delete', array('class' => 'btn btn-xs btn-danger delete-btns')) }}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-12">
                {{ $events->links() }}
            </div>
        </div>
        @else
        <div class="alert alert-danger alert-block">
            There are no events
        </div>
        @endif

    </div>
</div>

@stop
@section('script')

