@extends('site.layouts._two_column')

@section('title')
    {{ trans('word.profile') }}
@stop

@section('breadcrumb')
    <li>{{ trans('word.profile') }}</li>
@stop

@section('content')

    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="#profile" data-toggle="tab"><i class="fa fa-user"></i>&nbsp;{{ trans('word.profile') }}</a></li>
        <li><a href="#posts" data-toggle="tab"><i class="fa fa-book"></i>&nbsp;{{ trans('word.blog') }}</a></li>
        <li><a href="#subscriptions" data-toggle="tab"><i class="fa fa-ticket"></i>&nbsp;{{ trans('word.subscriptions') }}</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="profile">
            @if(Helper::isOwner($user->id))
                <h1><i class="fa fa-2x fa-edit"></i> <a href="{{ action('UsersController@edit',$user->id)}}">{{ trans('word.edit') }}</a></h1>
            @endif
            <div class="col-md-12">
                <h1></h1>
                @include('site.users._detail')
            </div>

        </div>
        <div class="tab-pane" id="posts">
            <div class="panel panel-primary">
                <ul class="list-group">
                    @if(count($user->blogs))
                        @foreach($user->blogs as $post)
                            <li class="list-group-item">
                                <div class="pull-right">
                                    <i class="fa fa-edit "></i>
                                    <a href="{{ action('BlogsController@edit',$post->id)}}">{{ trans('word.edit') }}</a>
                                </div>
                                {{ link_to_action('BlogsController@show',$post->title,$post->id) }}
                            </li>
                        @endforeach
                    @else
                        <h1> Sorry You have no posts </h1>
                    @endif
                </ul>
            </div>
        </div>

        <div class="tab-pane" id="subscriptions">
            <div class="panel panel-primary">
                <ul class="list-group">
                    @if(Helper::isOwner($user->id))
                        @foreach($user->subscriptions as $event)
                            {{ link_to_action('EventsController@show',$event->title,$event->id,array('class'=>'list-group-item')) }}
                        @endforeach
                    @else
                        <h1> Sorry No Data Available </h1>
                    @endif
                </ul>
            </div>
        </div>
    </div>

<script>
    $(function () {
        $('#myTab a:last').tab('show')
    })
</script>
@stop
