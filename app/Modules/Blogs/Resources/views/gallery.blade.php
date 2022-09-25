@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
@endsection

@section('content')

@include('backend.components.errors')

<div class="col-lg-12">
    <div class="card card-bordered card-full">
        <div class="card-header">
            {{ $title }}
        </div>
        <div class="card-body">
            <form action="{{ route('upload_gallery_blogs',['id'=>$blog->id]) }}" class="dropzone" id="dropzoneFrom" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
            </form>

            <div class="row mt-2">
                @foreach ($gallery as $image)
                    <div class="col-lg-2 mb-2">
                        <div class="pet-gallery-card">
                            <img src="{{ $image->media_path }}" alt="{{ $blog->name }}" class="img-responsive img-thumbnail">
                            <a href="{{ route('destroy_media_blogs',$image->id) }}" class="btn btn-danger mt-1">{{ transWord('Delete') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>

    $(document).ready(function(){

     Dropzone.options.dropzoneFrom = {
      autoProcessQueue: false,
      acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg",
      init: function(){
       var submitButton = document.querySelector('#submit-all');
       myDropzone = this;
       submitButton.addEventListener("click", function(){
        alert(1);
        myDropzone.processQueue();
       });
       this.on("complete", function(){
        if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
        {
         var _this = this;
         _this.removeAllFiles();
        }
        list_image();
       });
      },
     };

    });
</script>
@endsection
