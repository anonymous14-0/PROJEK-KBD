<?php

namespace Tests\Feature\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_inactive_users_can_not_authenticate(): void
    {
        $user = User::factory()->create(['is_active' => false]);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertGuest();
    }

    public function test_users_with_temporary_password_are_redirected_to_profile(): void
    {
        $user = User::factory()->create(['must_change_password' => true]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('profile.edit', absolute: false));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors([
            'email' => LoginRequest::INVALID_LOGIN_MESSAGE.' Sisa percobaan login: 4 dari '.LoginRequest::MAX_LOGIN_ATTEMPTS.'.',
        ]);
    }

    public function test_rate_limited_login_shows_fifteen_minute_lockout_message(): void
    {
        $user = User::factory()->create();

        for ($attempt = 1; $attempt <= LoginRequest::MAX_LOGIN_ATTEMPTS; $attempt++) {
            $this->post('/login', [
                'email' => $user->email,
                'password' => 'wrong-password',
            ]);
        }

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors([
            'email' => LoginRequest::LOCKOUT_MESSAGE.' Silakan coba lagi dalam 15 menit.',
        ]);
    }

    public function test_rate_limited_login_can_try_again_after_fifteen_minutes(): void
    {
        $user = User::factory()->create();

        for ($attempt = 1; $attempt <= LoginRequest::MAX_LOGIN_ATTEMPTS; $attempt++) {
            $this->post('/login', [
                'email' => $user->email,
                'password' => 'wrong-password',
            ]);
        }

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertGuest();

        $this->travel(15)->minutes();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_failed_login_for_existing_user_is_recorded_in_activity_log(): void
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $this->assertDatabaseHas('aktivitas_log', [
            'id_user' => $user->id_user,
            'aktivitas' => "Percobaan login gagal untuk email {$user->email}",
        ]);
    }

    public function test_failed_login_for_unknown_email_is_recorded_in_activity_log(): void
    {
        $email = 'unknown@example.test';

        $this->post('/login', [
            'email' => $email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $this->assertDatabaseHas('aktivitas_log', [
            'id_user' => null,
            'aktivitas' => "Percobaan login gagal untuk email {$email}",
        ]);
    }

    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
