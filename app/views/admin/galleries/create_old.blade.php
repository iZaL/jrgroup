@extends('admin.layouts.default')

{{-- Content --}}
@section('content')
{{ HTML::style('css/dropzone.css') }}
{{ HTML::script('js/dropzone.js') }}
<h1 style="margin-top: 100px;">Create Gallery</h1>

{{ Form::open(array('method' => 'POST', 'action' => array('AdminGalleriesController@store'), 'files'=>true)) }}

<div class="form-group">
    {{ Form::label('event_id', 'Event:') }}
    {{ Form::select('event_id',$events ,NULL,array('class'=>'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('category_id', 'Category:') }}
    {{ Form::select('category_id',$categories ,NULL,array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('arabic_name', 'Title Arabic:') }}
    {{ Form::text('name', NULL,array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('arabic_name', 'Title English:') }}
    {{ Form::text('name', NULL,array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('arabic_name', 'Description Arabic:') }}
    {{ Form::textarea('name', NULL,array('class'=>'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('arabic_name', 'Description English:') }}
    {{ Form::textarea('name', NULL,array('class'=>'form-control')) }}
</div>
<div class="form-group">
    <div class="row">
        <label class="col-xs-3 round text-center">Images (Opional)</label>
    </div>
    <input type="text" class="dropzone dropzone-previews img-responsive" id="my-awesome-dropzone">
</div>

<div class="form-group">
    {{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
</div>
{{ Form::close() }}

@if ($errors->any())
<ul>
    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
</ul>
@endif
<?php $uploadUrl = URL::action('AdminGalleriesController@store'); ?>


<script>
    var FormDropzone = function () {

        return {
            //main function to initiate the module
            init: function () {

                Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element

                    //                    // The configuration we've talked about above
                                        autoProcessQueue: false,
                    //                    uploadMultiple: true,
                    //                    parallelUploads: 100,
                    //                    maxFiles: 100,
                    //                    previewsContainer: ".dropzone-previews",
                    url: '{{ $uploadUrl }}',
                    previewsContainer: ".dropzone-previews",
                    uploadMultiple: true,
                    parallelUploads: 100,
                    maxFiles: 5,


                    // The setting up of the dropzone
                    init: function() {
                        var myDropzone = this;

                        // First change the button to actually tell Dropzone to process the queue.
                        this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                            // Make sure that the form isn't actually being sent.
                            e.preventDefault();
                            e.stopPropagation();
                            myDropzone.processQueue();
                        });

                        // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                        // of the sending event because uploadMultiple is set to true.
                        this.on("sendingmultiple", function() {
                            // Gets triggered when the form is actually being sent.
                            // Hide the success button or the complete form.
                        });
                        this.on("successmultiple", function(files, response) {
                            // Gets triggered when the files have successfully been sent.
                            // Redirect user or notify of success.
                        });
                        this.on("errormultiple", function(files, response) {
                            // Gets triggered when there was an error sending the files.
                            // Maybe show form again, and notify user of error
                        });
                    }

                }
            }
        };
    }();
    $('document').ready(function () {
        FormDropzone.init();
        $('.fileinput').fileinput()


    });
</script>

@stop


