@extends('backend.layouts.master')

@section('title',$title)

@section('stylesheet')

@endsection

@section('content')

<div class="col-lg-12">
    <div class="card card-bordered card-full">
        <div class="card-header">
            <h4>{{ $title }}</h4>
        </div>
        <div class="card-inner">
            <table class="datatable-init-export nowrap table" data-export-title="Export">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ transWord('Title') }}</th>
                        <th>{{ transWord('Page Tag') }}</th>
                        <th>{{ transWord('Publish') }}</th>
                        <th>{{ transWord('Actions') }}</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($allpages as $index => $p)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ getDataFromJsonByLanguage($p->title) }}</td>
                        <td>{{ getDataFromJsonByLanguage($p->slug) }}</td>
                        <td>
                        @if ($p->publish == 1)
                        <span class="badge badge-primary" style="font-weight: bold;">{{ transWord('Publish') }}</span>
                        @else
                        <span class="badge badge-danger" style="font-weight: bold;">{{ transWord('Un Publish') }}</span>
                        @endif
                        </td>
                        <td>
                            @can('show_pages')
                            <a class="btn btn-info btn-sm" href="{{ route('show_pages',Crypt::encrypt($p->id)) }}"><em class="icon ni ni-eye"></em> {{ transWord('Show') }}</a>
                            @endcan
                            @can('update_pages')
                            <a class="btn btn-info btn-sm" href="{{ route('edit_pages',Crypt::encrypt($p->id)) }}"><em class="icon ni ni-edit-fill"></em> {{ transWord('Edit') }}</a>
                            @endcan
                            {{-- @can('delete_pages')
                            <a class="btn btn-info btn-sm" id="deleteBtn" href="{{ route('destroy_pages',Crypt::encrypt($p->id)) }}" onclick="return confirm('{{ transWord('Are You Sure?') }}')"><em class="icon ni ni-trash-fill"></em> {{ transWord('Delete') }}</a>
                            @endcan --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>{{ transWord('Title') }}</th>
                        <th>{{ transWord('Page Tag') }}</th>
                        <th>{{ transWord('Publish') }}</th>
                        <th>{{ transWord('Actions') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@section('javascript')

@include('backend.components.datatablejs')

@endsection
