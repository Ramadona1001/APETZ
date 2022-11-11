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
                        @foreach ($chats as $chat)
                            @if($chat->send->id != auth()->user()->id)
                            <li class="chat-item">
                                <a class="chat-link chat-open" href="{{ route('open_my_chats',$chat->chat_id) }}">
                                    <div class="chat-media user-avatar bg-purple">
                                        <span>{{ Str::substr($chat->send->first_name, 0, 1).Str::substr($chat->send->last_name,0,1) }}</span>
                                    </div>
                                    <div class="chat-info">
                                        <div class="chat-from">
                                            <div class="name">{{ $chat->send->first_name.' '.$chat->send->last_name }}</div>
                                            <span class="time">{{ $chat->lastMessageSend($chat->send->id)->created_at->diffforHumans() }}</span>
                                        </div>
                                        <div class="chat-context">
                                            <div class="text">
                                                <p>{{ $chat->lastMessageSend($chat->send->id)->message }}</p>
                                            </div>
                                            <div class="status delivered">
                                                @if ($chat->lastMessageSend($chat->send->id)->read_at == null)
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
        <div class="nk-chat-body" style="display: flex; justify-content: center; align-items: center; background: #0d141d;">
            <h5>{{ transWord('Click on any chat to open') }}</h5>
        </div><!-- .nk-chat-body -->
    </div><!-- .nk-chat -->
</div>
@endsection

@section('javascript')

@endsection
