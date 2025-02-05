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

    <nav class="mb-4">
        <a href="{{ route('tasks.create') }}" class="link">Add Task</a>
    </nav>

    @forelse($tasks as $task)
        <div>
            <a
                href="{{ route('tasks.show', ['task' => $task->id]) }}"
                @class(['line-through' => $task->completed])
            >
                {{$task->title}}
            </a>
        </div>
    @empty
        <div>There are no tasks!</div>
    @endforelse

    @if($tasks->count())
        <div class="mt-4">
            {{ $tasks->links() }} {{-- display links for pagination --}}
        </div>
    @endif

@endsection
