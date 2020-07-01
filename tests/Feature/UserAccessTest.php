<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class UserAccessTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_a_guest_user_can_browse_index()
    {
        $response = $this->get('/');
        $response->assertDontSee('Manage Default Schedules');
        $response->assertSee('Login');
        $response->assertOk();
    }

    public function test_a_registered_user_can_browse_index()
    {
        //Having
        $guestUser = factory(User::class)->create();
        $guestUser->assignRole('user');
        $this->actingAs($guestUser);

        //When
        $response = $this->get('/');

        //Then
        $response->assertOk();
    }

    public function test_an_admin_user_can_browse_index()
    {
        //Having
        $adminUser = factory(User::class)->create();
        $adminUser->assignRole('admin');
        $this->actingAs($adminUser);

        //When
        $response = $this->get('/');

        //Then
        $response->assertOk();
    }
    
    
    public function test_admin_can_access_to_admin_features()
    {
        //Having
        $adminUser = factory(User::class)->create();
        $adminUser->assignRole('admin');
        $this->actingAs($adminUser);

        //When
        $response = $this->get('/');

        //Then
        $response->assertSee('Manage Default Schedules');
    }
    
    public function test_users_cannot_access_to_admin_features()
    {
        //Having
        $user = factory(User::class)->create();
        $user->assignRole('user');
        $this->actingAs($user);

        //When
        $response = $this->get('/');

        //Then
        $response->assertDontSee('Manage Default Schedules');
    }
    
    public function test_registered_user_can_access_to_user_features()
    {
        //Having
        $registeredUser = factory(User::class)->create();
        $registeredUser->assignRole('user');
        $this->actingAs($registeredUser);

        //When
        $response = $this->get('/');

        //Then
        $response->assertSee('Show Assets');
    }

}
