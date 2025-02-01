@extends('layouts.app')

@section('title', 'Create a Task')

@section('styles')
<style>
    .error_message {
        color: red;
        font-size: small;
    }
</style>

@endSection

@section('content')

<form method="POST" action="{{route('tasks.store')}}">
    {{-- Protect the submission for csrf atack. If this directive was not added, then we get a 419 error. --}}
    @csrf

    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
        {{-- <span>{{ $errors->first('title') ?? ''}}</span> --}}
        @error('title')
            <span class="error_message">{{ $message }}</span>
        @endError
    </div>
    <div>
        <label for="description">Description</label>
        <textarea name="description" id="description" rows="5"></textarea>
        {{-- <span>{{$errors->first('description') ?? '' }}</span> --}}
        @error('description')
            <span class="error_message">{{ $message }}</span>
        @endError
    </div>
    <div>
        <label for="long_description">Long Description</label>
        <textarea name="long_description" id="long_description" rows="10"></textarea>
        {{-- {{ $errors->first('long_description') ?? '' }} --}}
        @error('long_description')
            <span class="error_message">{{ $message }}</span>
        @endError
    </div>

    <input type="submit" value="Create Task">
</form>

@endSection
