@extends('site.layouts.home')
@section('maincontent')

    <div class="row">
       <div class="col-md-12">
           <address>
               <h2 style="background-color: rgba(221, 220, 219, 0.83); padding:10px;">Contact Us</h2>

               @if($contact)
               Phone   : {{ $contact->phone }} </br>
               Address : {{ $contact->address }}</br>
               Mobile  : {{ $contact->mobile }} </br>
               email address : {{ $contact->email }}
               @endif
           </address>
       </div>
    </div>


    <div class="row">
        <div class="col-md-8">
            {{ Form::open(array('method' => 'POST', 'action' => array('ContactsController@contact'), 'role'=>'form')) }}

            <div class="form-group">
                <label for="exampleInputEmail">{{ Lang::get('site.general.email') }}</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="{{ Lang::get('site.general.email') }}">
            </div>
            <div class="form-group">
                <label for="name">{{ Lang::get('site.general.name') }}</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="{{ Lang::get('site.general.name') }}">
            </div>
            <div class="form-group">
                <label for="comment">{{ Lang::get('site.general.comment') }}</label>
                <textarea class="form-control" id="comment" name="comment" placeholder="{{ Lang::get('site.general.comment') }}"></textarea>
            </div>
            <button type="submit" class="btn btn-default">{{ Lang::get('site.general.submit') }}</button>
            {{ Form::close() }}
        </div>
    </div>

@stop