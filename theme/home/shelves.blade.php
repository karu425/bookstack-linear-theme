@extends('layouts.tri')

@section('body')
    @include('shelves.parts.list', ['shelves' => $shelves, 'view' => $view])
@stop

@section('left')
    @include('home.parts.linear-directory')
@stop

@section('right')
    @include('common.view-blocks', ['location' => 'home-non-default', 'position' => 'right'])
@stop
