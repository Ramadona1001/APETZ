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
                        <th>{{ transWord('Following') }}</th>
                        <th>{{ transWord('Follower') }}</th>
                        <th>{{ transWord('Follow At') }}</th>
                    </tr>
                </thead>

                <tbody id="permissionTable">
                    @foreach ($user_follows as $index => $person)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $person->user->first_name.' '.$person->user->last_name }}</td>
                            <td>{{ $person->follow->first_name.' '.$person->follow->last_name }}</td>
                            <td>{{ $person->created_at }}</td>
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
