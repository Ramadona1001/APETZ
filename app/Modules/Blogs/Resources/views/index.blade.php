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
                        <th>{{ transWord('Title') }}</th>
                        <th>{{ transWord('Content') }}</th>
                        <th>{{ transWord('Publish') }}</th>
                        <th>{{ transWord('Actions') }}</th>
                    </tr>
                </thead>

                <tbody id="permissionTable">

                    @foreach ($blogs as $index => $blog)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ getDataFromJsonByLanguage($blog->title) }}</td>
                        <td>{{ getDataFromJsonByLanguage($blog->content) }}</td>
                        <td>
                        @if ($blog->publish == 1)
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
                                                @can('show_blogs')
                                                <li><a href="{{ route('edit_blogs',$blog->id) }}"><em class="icon ni ni-edit-fill"></em><span>{{ transWord('Edit') }}</span></a></li>
                                                @endcan
                                                @can('show_blogs_reactions')
                                                <li><a href="{{ route('reactions_blogs',$blog->id) }}"><em class="icon ni ni-check"></em><span>{{ transWord('Rections') }}</span></a></li>
                                                @endcan
                                                @can('show_blogs_comments')
                                                <li><a href="{{ route('comments_blogs',$blog->id) }}"><em class="icon ni ni-comments"></em><span>{{ transWord('Comments') }}</span></a></li>
                                                @endcan
                                                @can('show_blogs_share')
                                                <li><a href="{{ route('share_blogs',$blog->id) }}"><em class="icon ni ni-send"></em><span>{{ transWord('Share') }}</span></a></li>
                                                @endcan
                                                @can('create_blogs')
                                                <li><a href="{{ route('gallery_blogs',$blog->id) }}"><em class="icon ni ni-play-fill"></em><span>{{ transWord('Gallery') }}</span></a></li>
                                                @endcan
                                                @can('update_blogs')
                                                <li><a href="{{ route('show_blogs',$blog->id) }}"><em class="icon ni ni-eye"></em><span>{{ transWord('Details') }}</span></a></li>
                                                @endcan
                                                @can('delete_blogs')
                                                <li><a href="{{ route('destroy_blogs',$blog->id) }}" onclick="return confirm('Are You Sure?')"><em class="icon ni ni-trash"></em><span>{{ transWord('Delete') }}</span></a></li>
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
