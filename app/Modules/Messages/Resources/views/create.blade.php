@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

@include('backend.components.errors')

<div class="row clearfix">
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
                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <label style="color:red;font-style: italic">{{ transWord('*Hint Put , Between Tags*') }}</label>
                        </div>
                    </div>

                    <div class="row">
                    {!! BuildFields('tags' , null , 'text' ,['required' => 'required']) !!}
                    </div>

                    <hr>
                    <div class="row">
                    {!! BuildFields('meta_title' , null , 'text') !!}
                    </div>

                    <hr>
                    <div class="row">
                    {!! BuildFields('meta_desc' , null , 'text') !!}
                    </div>

                    <hr>
                    <div class="row">
                    {!! BuildFields('meta_keywords' , null , 'text') !!}
                    </div>

                    <hr>
                    <div class="row">
                    {!! BuildFields('content' , null , 'textarea' , ['required' => 'required']) !!}
                    </div>

                    <hr>
                    <label for="blog_img">{{ transWord('Image') }}</label>
                    <input type="file" name="blog_img" id="blog_img" class="form-control" accept="image/*" required>
                    <hr>

                    <label for="type">{{ transWord('Type') }}</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="">{{ transWord('Please Type') }}</option>
                        @foreach (getBlogTypes() as $index => $type)
                            <option value="{{ $index }}">{{ transWord($type) }}</option>
                        @endforeach
                    </select>

                    <hr>

                    <label for="publish">{{ transWord('Publish') }}</label>
                    <select name="publish" id="publish" class="form-control" required>
                        <option value="">{{ transWord('Please Select') }}</option>
                        <option value="1">{{ transWord('Publish') }}</option>
                        <option value="2">{{ transWord('Unpublish') }}</option>
                    </select>
                    <hr>
                    <button type="submit" class="btn btn-primary"><i class="icon-plus"></i>&nbsp;{{ transWord('Save') }}</button>
                </form>
            </div>
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
