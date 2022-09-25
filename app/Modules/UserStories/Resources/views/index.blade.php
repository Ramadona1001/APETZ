@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')
<style>
    .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)}
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>
@endsection

@section('content')

<div class="col-lg-12">
    <div class="card card-preview">
        <div class="card-header">
            <h4>{{ $title }}</h4>
        </div>
        <div class="card-inner">
            <table class="datatable-init-export nowrap table" data-export-title="Export">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ transWord('User') }}</th>
                        <th>{{ transWord('Image') }}</th>
                        <th>{{ transWord('Text') }}</th>
                        <th>{{ transWord('Upload Date') }}</th>
                        <th>{{ transWord('Expire Date') }}</th>
                        <th>{{ transWord('Publish') }}</th>
                    </tr>
                </thead>

                <tbody id="permissionTable">
                    @foreach ($user_stories as $index => $story)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $story->user->first_name.' '.$story->user->last_name }}</td>
                            <td>{{ $story->story_file }}</td>
                            <td>{{ $story->story_text }}</td>
                            <td>{{ $story->upload_date }}</td>
                            <td>{{ $story->expire_date }}</td>
                            <td>
                                @if ($story->publish == 1)
                                    <span class="badge badge-primary" style="font-weight: bold;">{{ transWord('Publish') }}</span>
                                @else
                                    <span class="badge badge-danger" style="font-weight: bold;">{{ transWord('Un Publish') }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="imgStoryModel" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>
@endsection

@section('javascript')
<script>
    var modal = document.getElementById("myModal");
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }
    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
      modal.style.display = "none";
    }
</script>
@endsection
