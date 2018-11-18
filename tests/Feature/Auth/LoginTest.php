<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    /** @test */
    public function it_requires_an_email()
    {
        $response = $this->postJson(route('auth.login'));

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_requires_a_password()
    {
        $response = $this->postJson(route('auth.login'));

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function if_returns_a_validation_error_if_credentials_do_not_match()
    {
        $user = factory(User::class)->create([
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);

        $response = $this->postJson(route('auth.login'), [
            'email' => 'john@example.com',
            'password' => 'wrong-password',
        ]);

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_returns_a_token_if_credentials_do_match()
    {
        $user = factory(User::class)->create([
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);

        $response = $this->postJson(route('auth.login'), [
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);

        $response->assertSuccessful();
        $response->assertJsonStructure(['meta' => ['token']]);
    }

    /** @test */
    public function it_returns_a_user_if_credentials_do_match()
    {
        $user = factory(User::class)->create([
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);

        $response = $this->postJson(route('auth.login'), [
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);

        $response->assertSuccessful();
        $response->assertJsonFragment([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
