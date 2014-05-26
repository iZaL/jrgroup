@extends('admin.layouts.default')

{{-- Content --}}
@section('content')
{{ HTML::style('assets/css/ion.rangeSlider.css') }}
{{ HTML::style('assets/css/ion.rangeSlider.skinSimple.css') }}
{{ HTML::script('assets/js/ion.rangeSlider.min.js') }}

<h1>Request Certificate</h1>

{{ Form::open(array('action' => 'AdminCertificateRequestsController@store')) }}
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                {{ Form::label('type', 'Type:') }}
                {{ Form::select('type_id',$types,NULL,array('class'=>'form-control','id'=>'type_id')) }}
            </div>
        </div>
        <div class="col-md-3">
            <h2><span id="type-price">0</span>  KD</h2>
        </div>
    </div>

    <?php $i = 1; ?>
    @foreach($metas as $meta)
        <?php $option = ['' => 'Select Certificate options'] + $meta->options->lists('name','id'); ?>
        <div class="row">
            <div class="col-md-9">
                @if($option)
                <div class="form-group">
                    <label>{{ $meta->name }} </label>
                    {{ Form::select('option_id'.$i,$option,NULL,array('class'=>'form-control options','onChange'=>'getOptionPrice(this)')) }}
                </div>
                @endif
            </div>
            <div class="col-md-3">
                <h2><span id="option-price{{$i}}">0</span> KD</h2>
            </div>
        </div>

    <?php $i++; ?>
    @endforeach

    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                {{ Form::label('quantity', 'Quantity:') }}
                {{ Form::text('quantity', NULL,array('class'=>'form-control')) }}
            </div>
        </div>
        <div class="col-md-3">
            <h2>40KD</h2>
        </div>
    </div>
    <div class="form-group">
        {{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
    </div>
{{ Form::close() }}

@if ($errors->any())
<div class="alert alert-danger alert-block">
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
</div>
@endif
<script>
    $("#quantity").ionRangeSlider({
        min: 0,
        max: 20,
        type: 'single',
        step: 1,
        postfix: " certificates",
        prettify: false,
        hasGrid: true,
        onChange: function() {
            var quantity = $('#quanity').val();
            alert(quantity);
        }
    });

    $( "#type_id" ).change(function() {

        //ajax query
        var typeId = $('#type_id').val();
        if(typeId) {
            $.ajax({
                url: 'http://localhost:8000/admin/certificate-type/' + typeId + '/get-price',
                type: 'GET',
                cache : true,
                dataType: "json",
                error: function(xhr, textStatus, errorThrown) {
                    //
                },
                success: function(data) {
                    if(data) {
                        $('#type-price').html(data);
                    }
                }
            });
        } else {
            alert(typeId);
        }

    });


    $( "#type_id" ).change(function() {

        //ajax query
        var typeId = $('#type_id').val();
        if(typeId) {
            $.ajax({
                url: 'http://localhost:8000/admin/certificate-type/' + typeId + '/get-price',
                type: 'GET',
                cache : true,
                dataType: "json",
                error: function(xhr, textStatus, errorThrown) {
                    //
                },
                success: function(data) {
                    if(data) {
                        $('#type-price').html(data);
                    }
                }
            });
        } else {
            alert(typeId);
        }

    });
    function getOptionPrice(sel) {
        var value = sel.value;
        var a = sel.attr('')
        alert(value);
    }
</script>
@stop