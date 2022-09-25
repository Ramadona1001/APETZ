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
                        <th>{{ transWord('Profile Image') }}</th>
                        <th>{{ transWord('First Name') }}</th>
                        <th>{{ transWord('Last Name') }}</th>
                        <th>{{ transWord('Email Address') }}</th>
                        <th>{{ transWord('Mobile') }}</th>
                        <th>{{ transWord('Publish') }}</th>
                        <th>{{ transWord('Roles') }}</th>
                        <th>{{ transWord('Actions') }}</th>
                    </tr>
                </thead>

                <tbody id="permissionTable">
                    @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="circle">
                                <img class="rounded-circle" width="50px" height="50px" src="{{ $user->avatar }}" alt="">
                            </div>
                        </td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->mobile }}</td>
                        <td>
                            @if ($user->publish == 1)
                                <span class="badge badge-primary" style="font-weight: bold;">{{ transWord('Publish') }}</span>
                            @else
                                <span class="badge badge-danger" style="font-weight: bold;">{{ transWord('Un Publish') }}</span>
                            @endif
                        </td>
                        <td>
                        @foreach (getUserRole($user->id) as $item)
                        <span class="badge badge-primary" style="font-weight: bold;">{{ $item }}</span>
                        @endforeach
                        </td>
                        <td class="nk-tb-col nk-tb-col-tools">
                            <ul class="nk-tb-actions gx-1">
                                <li>
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="link-list-opt no-bdr">
                                                @can('show_users')
                                                <li><a href="{{ route('edit_users',$user->id) }}"><em class="icon ni ni-edit-fill"></em><span>{{ transWord('Edit') }}</span></a></li>
                                                @endcan
                                                @can('update_users')
                                                <li><a href="{{ route('show_users',$user->id) }}"><em class="icon ni ni-eye"></em><span>{{ transWord('Details') }}</span></a></li>
                                                @endcan
                                                @can('delete_users')
                                                <li><a href="{{ route('destroy_users',$user->id) }}" onclick="return confirm('Are You Sure?')"><em class="icon ni ni-trash"></em><span>{{ transWord('Delete') }}</span></a></li>
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
