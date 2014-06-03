<div class="panel panel-default">
    <div class="panel-heading">
        {{ Lang::get('site.general.newsletter_subscribe') }}
    </div>
    <div class="panel-body">
        <div class="form-group">
            {{ Form::open(array('action'=>'NewslettersController@store')) }}
            <div class="input-group">
                <div class="input-icon">
                    <i class="glyphicon glyphicon-envelope"></i>
                    {{Form::input('email','email',NULL,array('class'=>'form-control','placeholder'=> Lang::get('site.nav.email') ,'required'=>'"required"'))}}
                </div>
            <span class="input-group-btn">
                <button id="submit" class="btn btn-primary" type="submit">
                    <i class="glyphicon glyphicon-arrow-left glyphicon-fw"></i></button>
            </span>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>