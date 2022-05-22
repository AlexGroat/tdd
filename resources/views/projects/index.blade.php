<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h1>Birdboard</h1>

<ul>
    @forelse ($projects as $project)
    <li>
        <a href="{{ $project->path() }}">{{ $project->name }}</a></li>
    
    @empty
    <h2>No projects yet!</h2>
    @endforelse
</ul>
</body>
</html>