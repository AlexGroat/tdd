<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="/projects" class="container" style="padding-top: 40px">
        @csrf
        <h1 class="heading is-1">Create a Project</h1>
        <div class="field">
            <label class="label" for="name">Name</label>

            <div class="control">
                <input type="text" class="input" name="name" placeholder="Name">
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">Description</label>

            <div class="control">
                <input type="text" class="input" name="description" placeholder="Description">
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Create Project</button>
            </div>
        </div>
    </form>



</body>

</html>