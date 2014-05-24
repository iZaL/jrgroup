@extends('site.master')

@section('title')
    {{ $event->title }}
@stop

@section('content')
    {{ LocaleHelper::getLocaled($event->title,$event->title_en) }}
@stop