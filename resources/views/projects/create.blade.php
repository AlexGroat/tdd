@extends('layouts.app')

@section('content')
<div>
    <form method="POST" action="/projects" class="container" style="padding-top: 15px">
        @csrf
        <h1 class="text-2xl mb-2">Create a Project</h1>
        <div class="field">
            <label class="label block mb-2 text-md font-medium text-gray-900" for="name">Name</label>

            <div class="control">
                <input type="text" class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" name="name" placeholder="Name">
            </div>
        </div>

        <div class="field">
            <label class="label block mb-2 text-md font-medium text-gray-900" for="description">Description</label>

            <div class="control">
                <textarea type="text" class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5" name="description" placeholder="Description"></textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="mt-2 text-white bg-sky-500 hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                    Create Project
                </button>
                <a href="/projects" class="text-red-500 hover:underline">Go Back</a>
            </div>
        </div>
    </form>
</div>

@endsection