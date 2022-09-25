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
                        <th>{{ transWord('Share Blog') }}</th>
                        <th>{{ transWord('Caption') }}</th>
                        <th>{{ transWord('At') }}</th>
                    </tr>
                </thead>

                <tbody id="permissionTable">
                    @foreach ($share as $index => $sh)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $sh->shareUser->first_name.' '.$sh->shareUser->last_name }}</td>
                        <td>{{ getDataFromJsonByLanguage($sh->title) }}</td>
                        <td>{{ $sh->share_caption }}</td>
                        <td>{{ $sh->shared_at }}</td>
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
