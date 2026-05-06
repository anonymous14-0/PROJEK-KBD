<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_registration_screen_is_disabled(): void
    {
        $response = $this->get('/register');

        $response->assertNotFound();
    }

    public function test_public_registration_post_is_disabled(): void
    {
        $response = $this->post('/register', [
            'nama_lengkap' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'New-password-123!',
            'password_confirmation' => 'New-password-123!',
        ]);

        $this->assertGuest();
        $response->assertNotFound();
    }
}
