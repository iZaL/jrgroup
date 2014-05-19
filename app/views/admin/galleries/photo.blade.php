@extends('admin.layouts.default')

{{-- Content --}}
@section('content')
{{ HTML::style('css/dropzone.css') }}
{{ HTML::script('js/dropzone.js') }}
<h1>Add Edit Photos</h1>
<!--{{ Form::open(array('url' => 'admin/upload', 'class'=>'dropzone', 'id'=>'my-dropzone')) }}-->
{{ Form::open(array('method' => 'POST', 'action' => array('AdminGalleriesController@postPhotos',$gallery->id), 'class'=>'dropzone', 'id'=>'my-dropzone')) }}

<!-- Single file upload
<div class="dz-default dz-message"><span>Drop files here to upload</span></div>
-->
<!-- Multiple file upload-->
<div class="fallback">
    <input name="file" type="file" multiple />
</div>

{{ Form::close() }}
<h1>Delete Photos </h1>

<div class="row ">
    <div class="col-md-12">
        <table class="table table-striped custab well">
            <thead>
            <tr>
                <th>Image </th>
            </tr>
            @foreach($gallery->photos as $photo)
            <tr>
                <td> {{ HTML::image('uploads/thumbnail/'.$photo->name.'','image1',array('class'=>'img-responsive img-thumbnail')) }} </td>
                <td>
                    {{ Form::open(array('method' => 'DELETE', 'action' => array('AdminPhotosController@destroy', $photo->id))) }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                    {{ Form::close() }}
                </td>
            </tr>

            @endforeach
        </table>
    </div>
</div>
<script language="javascript">


    // myDropzone is the configuration for the element that has an id attribute
    // with the value my-dropzone (or myDropzone)
    Dropzone.options.myDropzone = {
        init: function() {
            this.on("addedfile", function(file) {

                var removeButton = Dropzone.createElement('<a class="dz-remove">Remove file</a>');
                var _this = this;

                removeButton.addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var fileInfo = new Array();
                    fileInfo['name']=file.name;

                    $.ajax({
                        type: "POST",
                        url: "{{ url('/delete-image') }}",
                        data: {file: file.name},
                        beforeSend: function () {
                            // before send
                        },
                        success: function (response) {

                            if (response == 'success')
                                alert('deleted');
                        },
                        error: function () {
                            alert("error");
                        }
                    });


                    _this.removeFile(file);

                    // If you want to the delete the file on the server as well,
                    // you can do the AJAX request here.
                });


                // Add the button to the file preview element.
                file.previewElement.appendChild(removeButton);
            });
        }
    };

</script>
@stop
