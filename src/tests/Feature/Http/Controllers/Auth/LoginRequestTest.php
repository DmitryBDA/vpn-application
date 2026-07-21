<?php

namespace Http\Controllers\Auth;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LoginRequestTest extends TestCase
{
    use DatabaseTransactions;

    public function test_email_is_required(): void
    {
        $response = $this->post(route('login.store'), [
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_password_is_required(): void
    {
        $response = $this->post(route('login.store'), [
            'email' => 'test@example.com',
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_email_must_be_valid(): void
    {
        $response = $this->post(route('login.store'), [
            'email' => 'invalid-email',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_password_must_be_at_least_8_characters(): void
    {
        $response = $this->post(route('login.store'), [
            'email' => 'test@example.com',
            'password' => '1234567',
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_remember_must_be_boolean(): void
    {
        $response = $this->post(route('login.store'), [
            'email' => 'test@example.com',
            'password' => 'password123',
            'remember' => 'abc',
        ]);

        $response->assertSessionHasErrors('remember');
    }
}
