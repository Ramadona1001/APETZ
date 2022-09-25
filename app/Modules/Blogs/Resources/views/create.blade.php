@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

@include('backend.components.errors')

<div class="col-lg-12">
    <div class="card card-primary">
        <div class="card-header">
            <h4>{{ $title }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('store_blogs') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                {!! BuildFields('title' , null , 'text' ,['required' => 'required']) !!}
                </div>

                <div class="row">
                {!! BuildFields('content' , null , 'textarea' , ['required' => 'required']) !!}
                </div>


                <label for="publish">{{ transWord('Publish') }}</label>
                <select name="publish" id="publish" class="form-control" required>
                    <option value="">{{ transWord('Please Select') }}</option>
                    <option value="1">{{ transWord('Publish') }}</option>
                    <option value="2">{{ transWord('Unpublish') }}</option>
                </select>

                <button type="submit" class="btn btn-primary mt-3"><em class="icon ni ni-save-fill"></em>&nbsp;{{ transWord('Save') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
var languages = [];

<?php foreach(getLang() as $key => $val){ ?>
    languages.push('<?php echo $val; ?>');
<?php } ?>

var i = 0;
for (i; i < languages.length; i++) {
    CKEDITOR.replace( 'content['+languages[i]+']', {
        height: 300,
        filebrowserUploadUrl: "{{route('upload_pages', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
    CKEDITOR.on( 'required', function( evt ) {
        alert(1);
        CKEDITOR.showNotification( 'This field is required.', 'warning' );
        evt.cancel();
    } );
}

</script>
@endsection
