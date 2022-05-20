<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_user_can_create_project()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph()
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['name']);
    }

    public function test_project_requires_name()
    {
        $attributes = Project::factory()->raw(['name' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('name');
    }

    public function test_project_requires_description()
    {
        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
