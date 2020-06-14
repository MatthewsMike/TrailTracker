<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GuestUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_guest_user_can_browse_index()
    {
        $response = $this->get('/');
        $response->assertDontSee('Manage Default Schedules');
        $response->assertSee('Login');
        $response->assertStatus(200);
    }


}
