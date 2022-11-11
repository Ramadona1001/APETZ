@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')

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
                        <th>{{ transWord('Send') }}</th>
                        <th>{{ transWord('Receive') }}</th>
                        <th>{{ transWord('Created At') }}</th>
                        <th>{{ transWord('Actions') }}</th>
                    </tr>
                </thead>

                <tbody id="permissionTable">
                    @foreach ($chats as $index => $chat)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $chat->send->first_name.' '.$chat->send->last_name }}</td>
                        <td>{{ $chat->receive->first_name.' '.$chat->receive->last_name }}</td>
                        <td>{{ $chat->created_at }}</td>
                        <td>
                            <a class="btn btn-secondary btn-sm" href="{{ route('show_chats',['id'=>Crypt::encrypt($chat->id)]) }}"><em class="icon ni ni-eye"></em>{{ transWord('Show') }}</a>
                            <a class="btn btn-secondary btn-sm" id="deleteBtn" href="{{ route('destroy_chats',['id'=>Crypt::encrypt($chat->id)]) }}" onclick="return confirm('{{ transWord('Are You Sure?') }}')"><em class="icon ni ni-trash"></em>{{ transWord('Delete') }}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection
