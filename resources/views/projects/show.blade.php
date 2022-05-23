@extends('layouts.app')

@section('content')

<div class="flex items-center justify-between">
    <h1 class="text-3xl"> {{ $project->name }}</h1>

    <a href="/projects"><button class="mt-2 text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Go Back</button></a>
</div>

<div>{{ $project->description }}</div>
@endsection