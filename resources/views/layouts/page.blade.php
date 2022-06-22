@extends('layouts.master')

@section('defer','defer')

@section('content')
    @include('layouts.page.menu')
    @yield('page')
    @include('layouts.page.service')
    @include('layouts.page.footer')
@endsection
