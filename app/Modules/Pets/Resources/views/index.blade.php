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
                        <th>{{ transWord('Name') }}</th>
                        <th>{{ transWord('Type') }}</th>
                        <th>{{ transWord('Location') }}</th>
                        <th>{{ transWord('Nationality') }}</th>
                        <th>{{ transWord('User') }}</th>
                        <th>{{ transWord('Available Match') }}</th>
                        <th>{{ transWord('Publish') }}</th>
                        <th>{{ transWord('Actions') }}</th>
                    </tr>
                </thead>

                <tbody id="permissionTable">
                    @foreach ($pets as $index => $pet)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $pet->name }}</td>
                        <td>{{ $pet->type->name }}</td>
                        <td>{{ $pet->location }}</td>
                        <td>{{ $pet->nationality }}</td>
                        <td>{{ $pet->user->first_name.' '.$pet->user->last_name }}</td>
                        <td>
                            @if ($pet->available_match == 1)
                                <span class="badge badge-primary">{{ transWord('Available') }}</span>
                            @else
                                <span class="badge badge-danger">{{ transWord('Not Available') }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($pet->publish == 1)
                                <span class="badge badge-primary" style="font-weight: bold;">{{ transWord('Publish') }}</span>
                            @else
                                <span class="badge badge-danger" style="font-weight: bold;">{{ transWord('Un Publish') }}</span>
                            @endif
                        </td>
                        <td class="nk-tb-col nk-tb-col-tools">
                            <ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="link-list-opt no-bdr">
                                                @can('show_pets')
                                                <li><a href="{{ route('edit_pets',$pet->id) }}"><em class="icon ni ni-edit-fill"></em><span>{{ transWord('Edit') }}</span></a></li>
                                                @endcan
                                                @can('create_pets')
                                                <li><a href="{{ route('gallery_pets',$pet->id) }}"><em class="icon ni ni-play-fill"></em><span>{{ transWord('Gallery') }}</span></a></li>
                                                @endcan
                                                @can('update_pets')
                                                <li><a href="{{ route('show_pets',$pet->id) }}"><em class="icon ni ni-eye"></em><span>{{ transWord('Details') }}</span></a></li>
                                                @endcan
                                                @can('delete_pets')
                                                <li><a href="{{ route('destroy_pets',$pet->id) }}" onclick="return confirm('Are You Sure?')"><em class="icon ni ni-trash"></em><span>{{ transWord('Delete') }}</span></a></li>
                                                @endcan
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </td>
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
