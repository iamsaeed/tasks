@extends('layouts.app')

@section('title', 'Task')

@section('content')
    <show-task :id="{{$task->id}}" :auth="{{Auth::user()}}" />
@endsection
