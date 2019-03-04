<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;

class RegistrationTest extends TestCase
{
    /** @test */
    public function it_requires_a_name()
    {
        $response = $this->postJson(route('auth.register'));

        $response->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function name_must_be_a_string()
    {
        $response = $this->postJson(route('auth.register'), [
            'name' => 123
        ]);

        $response->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function name_must_be_at_least_2_characters_long()
    {
        $response = $this->postJson(route('auth.register'), [
            'name' => 'J'
        ]);

        $response->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function name_must_be_at_most_255_characters_long()
    {
        $response = $this->postJson(route('auth.register'), [
            'name' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function it_requires_an_email()
    {
        $response = $this->postJson(route('auth.register'));

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_requires_a_valid_email()
    {
        $response = $this->postJson(route('auth.register'), [
            'email' => 'nope'
        ]);

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_requires_a_unique_email()
    {
        factory(User::class)->create([
            'email' => 'john@example.com',
        ]);

        $response = $this->postJson(route('auth.register'), [
            'email' => 'john@example.com',
        ]);

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_requires_a_password()
    {
        $response = $this->postJson(route('auth.register'));

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function password_must_be_a_string()
    {
        $response = $this->postJson(route('auth.register'), [
            'password' => 123,
            'password_confirmation' => 123
        ]);

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function password_must_be_confirmed()
    {
        $response = $this->postJson(route('auth.register'), [
            'password' => 'secret',
            'password_confirmation' => null
        ]);

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function password_must_be_at_least_6_characters_long()
    {
        $response = $this->postJson(route('auth.register'), [
            'password' => 'secre',
            'password_confirmation' => 'secre'
        ]);

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function password_must_be_at_most_255_characters_long()
    {
        $response = $this->postJson(route('auth.register'), [
            'password' => str_repeat('a', 256),
            'password_confirmation' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function it_registers_a_user()
    {
        $response = $this->postJson(route('auth.register'), [
            'name' => $name = 'John',
            'email' => $email = 'john@example.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'name' => $name,
            'email' => $email,
        ]);
    }

    /** @test */
    public function it_returns_a_user_on_registration()
    {
        $response = $this->postJson(route('auth.register'), [
            'name' => $name = 'John',
            'email' => $email = 'john@example.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);

        $response->assertSuccessful();
        
        $response->assertJsonFragment([
            'name' => $name,
            'email' => $email,
        ]);
    }

    /** @test */
    public function it_generates_a_random_confirmation_token_on_registration()
    {
        $response = $this->postJson(route('auth.register'), [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);

        $response->assertSuccessful();
        $this->assertNotNull(User::first()->confirmation_token);
    }
}
