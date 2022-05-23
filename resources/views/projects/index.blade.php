@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between">
    <h1 class="text-3xl text-gray-400">My Projects</h1>

    <a href="/projects/create"><button class="mt-2 text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Create Project</button></a>
</div>

<div class="lg:flex lg:flex-wrap -mx-3">
    @forelse ($projects as $project)
    <a href="{{ $project->path()}}">
        <div class="lg:w-1/3 px-2 pb-2 transition duration-300 hover:scale-105">
            <div class="bg-white rounded-3xl p-5 shadow mt-4" style="height: 200px;">
                <h3 class="text-xl font-normal mb-3 py-4 -ml-5 border-l-4 border-sky-400 pl-4">{{ $project->name }}</h3>

                <div class="text-gray-400">{{ Str::limit($project->description, 200) }}</div>
            </div>
    </a>
</div>
@empty
<h2>No projects yet!</h2>
@endforelse
</div>

@endsection