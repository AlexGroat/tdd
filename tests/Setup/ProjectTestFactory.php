<?php

namespace Tests\Setup;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;

class ProjectTestFactory
{
    protected $tasksCount = 0;

    public function withTasks($count)
    {
        $this->tasksCount = $count;

        return $this;
    }

    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }

    public function create()
    {
        $project = Project::factory()->create([
            'owner_id' => $this->user ?? User::factory()->create()
        ]);

        Task::factory($this->tasksCount)->create([
            'project_id' => $project->id
        ]);

        return $project;
    }
}
