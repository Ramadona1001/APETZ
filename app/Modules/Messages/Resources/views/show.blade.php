@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')
<style>
.file {
  opacity: 0;
  width: 0.1px;
  height: 0.1px;
  position: absolute;
}

.file-input label {
    display: flex;
    cursor: pointer;
    font-size: 30px;
    margin-top: 10px;
    margin-right: 10px;
    color: #ccae62;
}

.file-name {
    font-size: 15px;
    color: #0d141d;
    margin-left: 5px;
    line-height: 20px;
    background: #ccae62;
    padding: 5px;
    border-radius: 10px;
    font-weight: bold;
}

input:hover + label,
input:focus + label {
  transform: scale(1.02);
}

/* Adding an outline to the label on focus */
input:focus + label {
  outline: 1px solid #000;
  outline: -webkit-focus-ring-color auto 2px;
}
</style>
@endsection

@section('content')

<div class="col-lg-12">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-chat">

                <div class="nk-chat-body">
                    <div class="nk-chat-head">
                        <ul class="nk-chat-head-info">
                            <li class="nk-chat-body-close">
                                <a href="#" class="btn btn-icon btn-trigger nk-chat-hide ml-n1"><em class="icon ni ni-arrow-left"></em></a>
                            </li>
                            <li class="nk-chat-head-user">
                                <div class="user-card">
                                    <div class="user-info">
                                        <div class="lead-text">
                                            {{ $chat->send->first_name.' '.$chat->send->last_name }} & {{ $chat->receive->first_name.' '.$chat->receive->last_name }}
                                        </div>
                                        <div class="sub-text"><span class="d-none d-sm-inline mr-1">{{ transWord('At') }} </span> {{ $chat->created_at }}</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div><!-- .nk-chat-head -->
                    <div class="nk-chat-panel" data-simplebar>
                        @foreach ($messages as $message)
                            @if ($message->send->id == auth()->user()->id)
                                <div class="chat is-you">
                                    <div class="chat-avatar">
                                        <div class="user-avatar bg-purple">
                                            <span title="{{ $message->send->first_name.' '.$message->send->last_name }}">{{ Str::substr($message->send->first_name, 0, 1).Str::substr($message->send->last_name,0,1) }}</span>
                                        </div>
                                    </div>
                                    <div class="chat-content">
                                        <div class="chat-bubbles">
                                            @if ($message->image != null)
                                            <div><img src="{{ $message->image }}" class="img-responsive img-thumbnail w-20 mb-3"></div>
                                            @endif
                                            <div class="chat-bubble">
                                                @if ($message->message != null)
                                                    @if (filter_var($message->message, FILTER_VALIDATE_URL))
                                                        <div class="chat-msg">
                                                            <a target="_blank" href="{{ $message->message }}">{{ $message->message }}</a>
                                                        </div>
                                                    @else
                                                        <div class="chat-msg"> {{ $message->message }} </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <ul class="chat-meta">
                                            <li>
                                                {{ $message->created_at }}
                                                @if($message->read_at == null)
                                                    <em title="{{ transWord('Not Seen') }}" class="icon ni ni-check-circle"></em>
                                                @else
                                                    <em title="{{ transWord('Seen') }}" class="icon ni ni-check-circle-fill"></em>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="chat is-me">
                                    <div class="chat-avatar">
                                        <div class="user-avatar bg-purple">
                                            <span title="{{ $message->send->first_name.' '.$message->send->last_name }}">{{ Str::substr($message->send->first_name, 0, 1).Str::substr($message->send->last_name,0,1) }}</span>
                                        </div>
                                    </div>
                                    <div class="chat-content">
                                        <div class="chat-bubbles">
                                            @if ($message->image != null)
                                                <div><img src="{{ $message->image }}" class="img-responsive img-thumbnail w-20 mb-3"></div>
                                            @endif
                                            <div class="chat-bubble">
                                                @if ($message->message != null)
                                                    @if (filter_var($message->message, FILTER_VALIDATE_URL))
                                                        <div class="chat-msg">
                                                            <a target="_blank" href="{{ $message->message }}">{{ $message->message }}</a>
                                                        </div>
                                                    @else
                                                        <div class="chat-msg"> {{ $message->message }} </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <ul class="chat-meta">
                                            <li>
                                                {{ $message->created_at }}
                                                @if($message->read_at == null)
                                                    <em title="{{ transWord('Not Seen') }}" class="icon ni ni-check-circle"></em>
                                                @else
                                                    <em title="{{ transWord('Seen') }}" class="icon ni ni-check-circle-fill"></em>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    @can ('write_chats')
                        <form id="chat-form2" method="POST" action="{{ route('send_chat_messages',$chat->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="nk-chat-editor">
                                <div class="nk-chat-editor-upload  ml-n1">
                                    <div class="file-input">
                                    <input type="file" id="file" class="file" accept="image/*" name="image">
                                    <label for="file">
                                        <em class="icon ni ni-plus-circle-fill"></em>
                                        <p class="file-name"></p>
                                    </label>
                                    </div>
                                </div>
                                <div class="nk-chat-editor-form">
                                    <div class="form-control-wrap">
                                        <textarea class="form-control form-control-simple no-resize" rows="1" id="default-textarea" placeholder="{{ transWord('Type your message...') }}" name="message" required></textarea>
                                    </div>
                                </div>
                                <ul class="nk-chat-editor-tools g-2">
                                    <li>
                                        <button type="submit" class="btn btn-round btn-primary btn-icon"><em class="icon ni ni-send-alt"></em></button>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    @endcan
                </div><!-- .nk-chat-body -->
            </div><!-- .nk-chat -->
        </div>
    </div>
</div>


@endsection

@section('javascript')
<script>
    $('.file-name').css('display','none');
    // document.getElementsByClassName('file-name').style.display = "none";
    const file = document.querySelector('#file');
        file.addEventListener('change', (e) => {
        const [file] = e.target.files;
        const { name: fileName, size } = file;
        const fileSize = (size / 1000).toFixed(2);
        const fileNameAndSize = `${fileName} - ${fileSize}KB`;
        document.querySelector('.file-name').textContent = fileNameAndSize;
        $('.file-name').css('display','block');
    });
</script>
@endsection
