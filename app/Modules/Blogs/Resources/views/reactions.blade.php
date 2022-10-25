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
            <div class="row">
                @foreach ($reactions_statistics as $r)
                    <div class="col-lg-2">
                        <div class="reaction-stat">
                            <img src="{{ URL::asset('/').setPublic().'reactions/'.reactions()[$r->user_reaction].'.svg' }}" alt="">
                            <h5>{{ $r->count }}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
            <table class="datatable-init-export nowrap table" data-export-title="Export">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ transWord('Post') }}</th>
                        <th>{{ transWord('User') }}</th>
                        <th>{{ transWord('Reaction') }}</th>
                        <th>{{ transWord('At') }}</th>
                    </tr>
                </thead>

                <tbody id="permissionTable">

                    @foreach ($reactions as $index => $reaction)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ getDataFromJsonByLanguage($reaction->blog->title) }}</td>
                        <td>{{ $reaction->user->first_name.' '.$reaction->user->last_name }}</td>
                        <td>
                            <img src="{{ URL::asset('/').setPublic().'reactions/'.reactions()[$reaction->user_reaction].'.svg' }}" alt="" srcset="">
                        </td>
                        <td>{{ $reaction->created_at }}</td>
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
