@extends('layouts.app')

@section('content')
<div class="flex items-end justify-between mb-6">
    <p class="text-xl text-gray-400"><a href="/projects" class="hover:underline hover:text-sky-500"> My Projects</a> / {{ $project->name }}</p>

    <a href="/projects/create"><button class="mt-2 text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Create Project</button></a>
</div>

<main class="mt-4">
    <div class="lg:flex -ml-4">
        <div class="lg:w-3/4 px-3 mb-4">
            <div class="mb-8">
                <h1 class="text-lg text-gray-400 mb-3">Tasks</h1>

                @foreach ($project->tasks as $task)
                <div class="bg-white rounded-3xl p-5 shadow mb-3">
                    <h3 class="text-lg font-normal mb-3 -ml-5 border-l-4 border-sky-400 pl-4">{{ $task->body }}</h3>
                </div>
                @endforeach

            </div>

            <div>
                <h1 class="text-lg text-gray-400 mb-3">General Notes</h1>

                <div class="bg-white rounded-3xl p-5 shadow">
                    <textarea class="text-md font-normal mb-3 py-2 pl-4 w-full border-none" style="min-height: 200px;">Lorem ipsum</textarea>
                </div>
            </div>
        </div>
        <div class="lg:w-1/4 px-3 mt-6">
            @include ('projects.card')
        </div>

        {{ $project->name }}
        {{ $project->description }}
    </div>
</main>


@endsection