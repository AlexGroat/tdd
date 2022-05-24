<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Facades\Tests\Setup\ProjectTestFactory;
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
        $this->signIn();

        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks', ['body' => 'test task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'test task']);
    }

    public function test_owner_can_update_tasks()
    {
        $this->signIn();

        $project = ProjectTestFactory::withTasks(1)->create();

        $this->patch($project->tasks[0]->path(), ['body' => 'change'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'change']);
    }

    public function test_project_has_tasks()
    {
        $project = ProjectTestFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', ['body' => 'lorem ipsum']);

        $this->get($project->path())
            ->assertSee('lorem ipsum');
    }

    public function test_task_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $project = ProjectTestFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
                'body' => 'changed',
                'completed' => true
            ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
    }

    public function test_task_requires_body()
    {
        $attributes = Task::factory()->raw(['body' => '']);

        $project = ProjectTestFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }
}
