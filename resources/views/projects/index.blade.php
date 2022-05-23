@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between">
    <h1 class="text-3xl"> Birdboard</h1>

    <a href="/projects/create"><button class="mt-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Create Project</button></a>
</div>

<div class="flex">
    @forelse ($projects as $project)
    <div class="bg-white mr-4 rounded-3xl p-4 shadow w-1/3 mt-4" style="height: 200px;">
        <h3 class="text-xl font-normal mb-4 py-4">{{ $project->name }}</h3>

        <div class="text-gray-400">{{ Str::limit($project->description, 200) }}</div>
    </div>
    @empty
    <h2>No projects yet!</h2>
    @endforelse
</div>

@endsection