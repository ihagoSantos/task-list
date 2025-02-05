@extends('layouts.app')

@section('content')
    @include('form', ['task' => $task])
@endSection
