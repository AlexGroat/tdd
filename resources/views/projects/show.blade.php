@extends('layouts.app')

@section('content')
<div class="flex items-end justify-between mb-3">
    <p class="text-xl text-gray-400"><a href="/projects" class="hover:underline hover:text-sky-500"> My Projects</a> / {{ $project->name }}
    </p>

    <a href="{{ $project->path() . '/edit' }}"><button class="ml-4 text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center">Edit Project</button></a>
</div>

<div class="mb-8">
    <p class="text-lg text-gray-400">{{ $project->description }}</p>
</div>

<main class="mt-4">
    <div class="lg:flex -ml-4">
        <div class="lg:w-3/4 px-3 mb-4">
            <div class="mb-8">
                <h1 class="text-lg text-gray-400 mb-3">Tasks</h1>

                @foreach ($project->tasks as $task)
                <div class="bg-white rounded-3xl p-6 shadow mb-2">
                    <form method="POST" action="{{ $task->path() }}">
                        @method('PATCH')
                        @csrf
                        <div class="flex items-center">
                            <input class="w-full {{ $task->completed ? 'text-gray-400' : '' }}" name="body" value="{{ $task->body }}">
                            <input type="checkbox" class="mr-2 rounded-full" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : ''}}>
                        </div>
                    </form>
                </div>
                @endforeach
                <div class="bg-white rounded-3xl p-5 shadow mb-3">
                    <form action="{{ $project->path() . '/tasks' }}" method="POST">
                        @csrf
                        <input placeholder="Add a new task..." class="w-full" name="body" />
                    </form>
                </div>

            </div>

            <div>
                <h1 class="text-lg text-gray-400 mb-3">General Notes</h1>

                <form method="POST" action="{{ $project->path() }}">
                    @csrf
                    @method('PATCH')
                    <textarea name="notes" class="text-md font-normal mb-3 py-2 pl-4 w-full border-none bg-white rounded-3xl p-5 shadow" style="min-height: 200px;" placeholder="Notes...">{{ $project->notes }}</textarea>

                    <button class="text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save</button>
                </form>

            </div>
        </div>
        <div class="lg:w-1/4 px-3 mt-6">
            @include ('projects.card')
        </div>
    </div>
</main>


@endsection