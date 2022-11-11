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
                <img src="{{ $blog->blog_img }}" style="width:150px;height:150px;display:block;margin-left:auto;margin-right:auto;" alt="">
                <hr>
                <form action="{{ route('update_blogs',Crypt::encrypt($blog->id)) }}" method="post" enctype="multipart/form-data">
                    @csrf

                        <div class="row">
                        {!! BuildFields('title' , ($blog->title) , 'text' ,['required' => 'required']) !!}
                        </div>
                        <hr>

                        <div class="row">
                        {!! BuildFields('tags' , ($blog->tags) , 'text' ,['required' => 'required']) !!}
                        </div>

                        <hr>
                        <div class="row">
                        {!! BuildFields('meta_title' , ($blog->meta_title) , 'text') !!}
                        </div>

                        <hr>
                        <div class="row">
                        {!! BuildFields('meta_desc' , ($blog->meta_desc) , 'text') !!}
                        </div>

                        <hr>
                        <div class="row">
                        {!! BuildFields('meta_keywords' , ($blog->meta_keywords) , 'text') !!}
                        </div>

                        <hr>
                        <div class="row">
                        {!! BuildFields('content' , ($blog->content) , 'textarea' , ['required' => 'required']) !!}
                        </div>

                        <hr>
                    <label for="blog_img">{{ transWord('Image') }}</label>
                    <input type="file" name="blog_img" id="blog_img" class="form-control" accept="image/*">
                    <hr>

                    <label for="type">{{ transWord('Type') }}</label>
                    <select name="type" id="type" class="form-control" required>
                        @foreach (getBlogTypes() as $index => $type)
                            @if ($index == $blog->type)
                                <option value="{{ $index }}" selected>{{ transWord($type) }}</option>
                            @else
                                <option value="{{ $index }}">{{ transWord($type) }}</option>
                            @endif
                        @endforeach
                    </select>

                    <hr>

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
}

</script>
@endsection
