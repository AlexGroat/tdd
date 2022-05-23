<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SingleProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_has_path()
    {
        $this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $this->assertEquals('/projects/' . $project->id, $project->path());
    }

    public function test_belongs_to_owner()
    {
        $project = Project::factory()->create();

        $this->assertInstanceOf(User::class, $project->owner);
    }
}
