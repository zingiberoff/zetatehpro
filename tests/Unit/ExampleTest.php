<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testServerCreation()
    {
        Passport::actingAs(
            factory(User::class)->create(),
            ['projects']
        );

        $response = $this->post('/api/projects');

        $response->assertStatus(200);
    }
}
