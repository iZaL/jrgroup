@extends('site.master')
@section('title')
{{ Lang::get('site.general.profile') }}
@stop
@section('breadcrumb')
<li>{{ Lang::get('site.general.profile') }}</li>
@stop
@section('content')

    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="#profile" data-toggle="tab"><i class="fa fa-user"></i>&nbsp;{{ Lang::get('site.general.profile') }}</a></li>
        <li><a href="#posts" data-toggle="tab"><i class="fa fa-book"></i>&nbsp;{{ Lang::get('site.nav.posts') }}</a></li>
        <li><a href="#subscriptions" data-toggle="tab"><i class="fa fa-ticket"></i>&nbsp;{{ Lang::get('site.general.subscriptions') }}</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane active" id="profile">
            @if(Helper::isOwner($user->id))
                <h1><i class="fa fa-2x fa-edit"></i> <a href="{{ action('UserController@edit',$user->id)}}">{{ Lang::get('site.general.edit_profile') }}</a></h1>
            @endif
            <div class="col-md-12">
                <h1></h1>
                @include('site.user.detail')
            </div>

        </div>
        <div class="tab-pane" id="posts">
            <div class="panel panel-primary">
                <ul class="list-group">
                    @if(Helper::isOwner($user->id))
                    @foreach($user->posts as $post)
                        <li class="list-group-item">
                            <div class="pull-right">
                                <i class="fa fa-edit "></i>
                                <a href="{{ action('BlogsController@edit',$post->id)}}">{{ Lang::get('site.general.edit') }}</a>
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
