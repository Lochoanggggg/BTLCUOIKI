<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_register_and_is_authenticated(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'Nguyen Van A',
            'email' => 'customer@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('profile'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'customer@example.com', 'role' => 'customer']);
    }

    public function test_user_can_login_and_logout(): void
    {
        $user = User::factory()->create([
            'email' => 'login@example.com',
            'password' => Hash::make('password123'),
        ]);

        $this->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'password123',
        ])->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($user);

        $this->post(route('logout'))->assertRedirect(route('home'));
        $this->assertGuest();
    }

    public function test_only_owner_can_access_owner_dashboard(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $owner = User::factory()->create(['role' => 'owner']);

        $this->actingAs($customer)->get(route('owner.dashboard'))->assertForbidden();
        $this->actingAs($owner)->get(route('owner.dashboard'))->assertOk();
    }

    public function test_profile_requires_authentication(): void
    {
        $this->get(route('profile'))->assertRedirect(route('login'));
    }
}
