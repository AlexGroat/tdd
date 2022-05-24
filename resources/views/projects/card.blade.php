<a href="{{ $project->path()}}">

    <div class="bg-white rounded-3xl p-5 shadow mt-4" style="height: 200px;">
        <h3 class="text-xl font-normal mb-3 py-4 -ml-5 border-l-4 rounded border-sky-400 pl-4">{{ $project->name }}</h3>

        <div class="text-gray-400">{{ Str::limit($project->description, 100) }}</div>

</a>