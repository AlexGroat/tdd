<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_add_tasks()
    {
        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks')->assertRedirect('login');
    }

    public function test_owner_can_add_tasks()
    {
    
    }

    public function test_project_has_tasks()
    {
        $this->signIn();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->post($project->path() . '/tasks', ['body' => 'lorem ipsum']);

        $this->get($project->path())
            ->assertSee('lorem ipsum');
    }

    public function test_task_requires_body()
    {
        $this->signIn();

        $attributes = Task::factory()->raw(['body' => '']);

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->post($project->path() . '/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
