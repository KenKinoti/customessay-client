@extends('layouts.app')
@section('title', $title)

@section('app')
    <h4 class="pl-3 pb-3">{{ $title }}</h4>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                {!! $dataTable->table(['class' => 'table table-striped']) !!}
            </div>
        </div>
    </div>
@stop
@include('app.partials.data_tables.js_files')
