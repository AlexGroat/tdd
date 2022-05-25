<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Facades\Tests\Setup\ProjectTestFactory;
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
        $this->get($project->path() . '/edit')->assertRedirect('login');
    }

    public function test_user_can_create_project()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'notes' => 'General notes'
        ];

        $response  = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();

        $response->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
            ->assertSee($attributes['name'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    public function test_user_can_update_project()
    {
        $project = ProjectTestFactory::create();

        $this->actingAs($project->owner)->patch($project->path(), $attributes = [
            'name' => 'change',
            'description' => 'change',
            'notes' => 'change'
        ])->assertRedirect($project->path());

        $this->get($project->path() . '/edit')->assertStatus(200);

        $this->assertDatabaseHas('projects', $attributes);
    }

    public function test_user_can_view_their_project()
    {
        $project = ProjectTestFactory::create();

        $this->actingAs($project->owner)->get($project->path())
            ->assertSee($project->name)
            ->assertSee($project->description);
    }

    public function test_auth_user_cannot_view_others_projects()
    {
        $this->signIn();

        // $this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
    }

    public function test_auth_user_cannot_update_others_projects()
    {
        $this->signIn();

        // $this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->patch($project->path())->assertStatus(403);
    }

    public function test_project_requires_name()
    {
        $this->signIn();

        $attributes = Project::factory()->raw(['name' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('name');
    }

    public function test_project_requires_description()
    {
        $this->signIn();

        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
