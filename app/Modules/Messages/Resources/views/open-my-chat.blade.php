@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

<div class="col-lg-12">
    <div class="nk-chat">
        <div class="nk-chat-aside">
            <div class="nk-chat-aside-head">
                <div class="nk-chat-aside-user">
                    <div class="dropdown">
                        <div class="title">{{ $title }}</div>
                    </div>
                </div>
            </div><!-- .nk-chat-aside-head -->

            <div class="nk-chat-aside-body" data-simplebar>
                <div class="nk-chat-list">
                    <h6 class="title overline-title-alt">{{ transWord('Messages') }}</h6>
                    <ul class="chat-list">
                        @foreach ($chats as $open_chat)
                            @if($open_chat->send->id != auth()->user()->id)
                            <li class="chat-item @if($open_chat->send->id == $chat->send->id) is-unread @endif">
                                <a class="chat-link chat-open" href="{{ route('open_my_chats',$open_chat->chat_id) }}">
                                    <div class="chat-media user-avatar bg-purple">
                                        <span>{{ Str::substr($open_chat->send->first_name, 0, 1).Str::substr($open_chat->send->last_name,0,1) }}</span>
                                    </div>
                                    <div class="chat-info">
                                        <div class="chat-from">
                                            <div class="name">{{ $open_chat->send->first_name.' '.$open_chat->send->last_name }}</div>
                                            <span class="time">{{ $open_chat->lastMessageSend($open_chat->send->id)->created_at->diffforHumans() }}</span>
                                        </div>
                                        <div class="chat-context">
                                            <div class="text">
                                                <p>{{ $open_chat->lastMessageSend($open_chat->send->id)->message }}</p>
                                            </div>
                                            <div class="status delivered">
                                                @if ($open_chat->lastMessageSend($open_chat->send->id)->read_at == null)
                                                    <em class="icon ni ni-check-circle"></em>
                                                @else
                                                    <em class="icon ni ni-check-circle-fill"></em>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endif
                        @endforeach
                    </ul><!-- .chat-list -->
                </div><!-- .nk-chat-list -->
            </div>
        </div><!-- .nk-chat-aside -->
        <div class="nk-chat-body">
            <div class="nk-chat-head">
                <ul class="nk-chat-head-info">
                    <li class="nk-chat-body-close">
                        <a href="#" class="btn btn-icon btn-trigger nk-chat-hide ml-n1"><em class="icon ni ni-arrow-left"></em></a>
                    </li>
                    <li class="nk-chat-head-user">
                        <div class="user-card">
                            <div class="user-avatar bg-purple">
                                <span>IH</span>
                            </div>
                            <div class="user-info">
                                <div class="lead-text">Iliash Hossain</div>
                                <div class="sub-text"><span class="d-none d-sm-inline mr-1">Active </span> 35m ago</div>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="nk-chat-head-tools">
                    <li><a href="#" class="btn btn-icon btn-trigger text-primary"><em class="icon ni ni-call-fill"></em></a></li>
                    <li><a href="#" class="btn btn-icon btn-trigger text-primary"><em class="icon ni ni-video-fill"></em></a></li>
                    <li class="d-none d-sm-block">
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger text-primary" data-toggle="dropdown"><em class="icon ni ni-setting-fill"></em></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    <li><a class="dropdown-item" href="#"><em class="icon ni ni-archive"></em><span>Make as Archive</span></a></li>
                                    <li><a class="dropdown-item" href="#"><em class="icon ni ni-cross-c"></em><span>Remove Conversion</span></a></li>
                                    <li><a class="dropdown-item" href="#"><em class="icon ni ni-setting"></em><span>More Options</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="mr-n1 mr-md-n2"><a href="#" class="btn btn-icon btn-trigger text-primary chat-profile-toggle"><em class="icon ni ni-alert-circle-fill"></em></a></li>
                </ul>
                <div class="nk-chat-head-search">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <div class="form-icon form-icon-left">
                                <em class="icon ni ni-search"></em>
                            </div>
                            <input type="text" class="form-control form-round" id="chat-search" placeholder="Search in Conversation">
                        </div>
                    </div>
                </div><!-- .nk-chat-head-search -->
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

            <div class="nk-chat-editor">
                <div class="nk-chat-editor-upload  ml-n1">
                    <a href="#" class="btn btn-sm btn-icon btn-trigger text-primary toggle-opt" data-target="chat-upload"><em class="icon ni ni-plus-circle-fill"></em></a>
                    <div class="chat-upload-option" data-content="chat-upload">
                        <ul class="">
                            <li><a href="#"><em class="icon ni ni-img-fill"></em></a></li>
                            <li><a href="#"><em class="icon ni ni-camera-fill"></em></a></li>
                            <li><a href="#"><em class="icon ni ni-mic"></em></a></li>
                            <li><a href="#"><em class="icon ni ni-grid-sq"></em></a></li>
                        </ul>
                    </div>
                </div>
                <div class="nk-chat-editor-form">
                    <div class="form-control-wrap">
                        <textarea class="form-control form-control-simple no-resize" rows="1" id="default-textarea" placeholder="Type your message..."></textarea>
                    </div>
                </div>
                <ul class="nk-chat-editor-tools g-2">
                    <li>
                        <a href="#" class="btn btn-sm btn-icon btn-trigger text-primary"><em class="icon ni ni-happyf-fill"></em></a>
                    </li>
                    <li>
                        <button class="btn btn-round btn-primary btn-icon"><em class="icon ni ni-send-alt"></em></button>
                    </li>
                </ul>
            </div><!-- .nk-chat-editor -->

        </div><!-- .nk-chat-body -->
    </div><!-- .nk-chat -->
</div>
@endsection

@section('javascript')

@endsection
