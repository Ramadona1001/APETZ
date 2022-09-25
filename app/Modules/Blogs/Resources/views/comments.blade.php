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
                        <th>{{ transWord('User') }}</th>
                        <th>{{ transWord('Blog') }}</th>
                        <th>{{ transWord('Comment') }}</th>
                        <th>{{ transWord('Publish') }}</th>
                        <th>{{ transWord('At') }}</th>
                    </tr>
                </thead>

                <tbody id="permissionTable">

                    @foreach ($comments as $index => $comment)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $comment->user->first_name.' '.$comment->user->last_name }}</td>
                        <td>{{ getDataFromJsonByLanguage($comment->blog->title) }}</td>
                        <td>{{ $comment->blog_comment }}</td>
                        <td>
                            @if ($comment->publish == 1)
                            <span class="badge badge-primary" style="font-weight: bold;">{{ transWord('Publish') }}</span>
                            @else
                            <span class="badge badge-danger" style="font-weight: bold;">{{ transWord('Waiting For Admin Approve') }}</span>
                            @endif
                        </td>
                        <td>{{ $comment->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection
