<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_guests_cannot_manage_projects()
    {
        $project = Project::factory()->create();

        $this->post('/projects', $project->toArray())->assertRedirect('login');

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');

        $this->get($project->path())->assertRedirect('login');
    }

    public function test_a_user_can_create_project()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(User::factory()->create());

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['name']);
    }

    public function test_user_can_view_their_project()
    {
        $this->be(User::factory()->create());

        $this->withoutExceptionHandling();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->get($project->path())
            ->assertSee($project->name)
            ->assertSee($project->description);
    }

    public function test_auth_user_cannot_view_others_projects()
    {
        $this->be(User::factory()->create());

        // $this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function test_project_requires_name()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['name' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('name');
    }

    public function test_project_requires_description()
    {
        $this->actingAs(User::factory()->create());

        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
