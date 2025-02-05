@extends('layouts.app')

@section('title', isset($task) ? 'Edit Task' : 'Add Task')

@section('styles')

@endSection

@section('content')

<form method="POST" action="{{ isset($task) ? route('tasks.update', ['task' => $task->id]) : route('tasks.store') }}">
    {{-- Protect the submission for csrf atack. If this directive was not added, then we get a 419 error. --}}
    @csrf
    @isset($task)
        @method('PUT')
    @endisset
    <div class="mb-4">
        <label for="title">Title</label>
        <input type="text" name="title" id="title"
            @class(['border-red-500' => $errors->has('title')])
            value="{{ $task->title ?? old('title') }}"/> {{-- the 'old' directive maintain the value whe the validation fails  --}}
        {{-- <span>{{ $errors->first('title') ?? ''}}</span> --}}
        @error('title')
            <span class="error">{{ $message }}</span>
        @endError
    </div>
    <div class="mb-4">
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="5"
            @class(['border-red-500' => $errors->has('description')])
        >{{ $task->title ?? old(key: 'description') }}</textarea>
        {{-- <span>{{$errors->first('description') ?? '' }}</span> --}}
        @error('description')
            <span class="error">{{ $message }}</span>
        @endError
    </div>
    <div class="mb-4">
        <label for="long_description">Long Description</label>
        <textarea name="long_description" id="long_description" rows="10"
            @class(['border-red-500' => $errors->has('long_description')])
        >{{ $task->long_description ?? old('long_description') }}</textarea>
        {{-- {{ $errors->first('long_description') ?? '' }} --}}
        @error('long_description')
            <span class="error">{{ $message }}</span>
        @endError
    </div>

    <div class="flex gap-2 items-center">
        <button type="submit" class="btn">
            @isset($task)
                span
            @else
                Add Task
            @endisset
        </button>
        <a href="{{route('tasks.index')}}" class="link">Cancel</a>
    </div>
</form>

@endSection
