@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
{{-- @isset($name)
<div>The name is: {{$name}}</div>
@endisset
 --}}


    {{-- @if(count($tasks) > 0)
        @foreach($tasks as $task)
            <div>
                <h3>{{$task->title}}</h3>
                <p>{{$task->description}}</p>
                <p>{{$task->created_at}}</p>
            </div>
        @endforeach
    @else
        <div>There are no tasks!</div>
    @endif --}}

    @forelse($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['id' => $task->id]) }}">
                <h3>{{$task->title}}</h3>
            </a>
        </div>
    @empty
        <div>There are no tasks!</div>
    @endforelse


@endsection
