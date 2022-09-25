@extends('backend.layouts.master')

@section('title',transWord('Translation'))

@section('stylesheet')

    @include('backend.components.datatablecss')

@endsection

@section('content')

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card card-bordered card-full">
                <div class="card-header">
                    <h4>{{ transWord('Add New Translation') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('store_new_langs') }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="word" placeholder="{{ transWord('Word') }}" required>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="translation" placeholder="{{ transWord('Translation') }}" required>
                        </div>
                        <button type="submit" class="btn btn-round btn-success">{{ transWord('Save') }}</button>
                    </form>
                </div>
            </div>
            <div class="card card-bordered card-full">
                <div class="card-header">
                    <h4>
                        {{ transWord('Translation').' ('.\Lang::getLocale().')' }}&nbsp;
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('store_langs') }}" method="POST">
                        @csrf
                        <div class="row">
                            @foreach ($langs as $index => $lang)
                                <div class="col-lg-3">
                                    <h6>{{ $lang->word }}</h6>
                                    <input type="hidden" name="ids[]" value="{{ $lang->id }}">
                                    <h6><input type="text" name="trans[]" value="{{ $lang->translation }}" class="form-control"></h6>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary"><em class="icon ni ni-save"></em>&nbsp;{{ transWord('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('javascript')
    @include('backend.components.datatablejs')
@endsection
