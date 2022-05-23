@extends('layouts.app')

@section('content')
<div class="ml-8">

    <div class="flex items-center justify-between">
        <h1 class="text-3xl"> Birdboard</h1>

        <a href="/projects/create"><button class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Create Project</button></a>
    </div>

    <ul class="mt-4">
        @forelse ($projects as $project)
        <li class="mt-1 text-blue-600 hover:underline">
            <a href="{{ $project->path() }}">{{ $project->name }}</a>
        </li>

        @empty
        <h2>No projects yet!</h2>
        @endforelse
    </ul>
</div>
@endsection