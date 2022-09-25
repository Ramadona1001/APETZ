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
            <form action="{{ route('update_blogs',$blog->id) }}" method="post" enctype="multipart/form-data">
                @csrf

                    <div class="row">
                    {!! BuildFields('title' , getDataFromJson($blog->title) , 'text' ,['required' => 'required']) !!}
                    </div>

                    <div class="row">
                    {!! BuildFields('content' , getDataFromJson($blog->content) , 'textarea' , ['required' => 'required']) !!}
                    </div>

                    <label for="publish">{{ transWord('Publish') }}</label>
                    <select name="publish" id="publish" class="form-control" required>
                        @if ($blog->publish == 1)
                        <option value="1">{{ transWord('Publish') }}</option>
                        <option value="2">{{ transWord('Unpublish') }}</option>
                        @else
                        <option value="2">{{ transWord('Unpublish') }}</option>
                        <option value="1">{{ transWord('Publish') }}</option>
                        @endif
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
}

</script>
@endsection
