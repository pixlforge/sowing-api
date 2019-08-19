<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;

class LoginTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = factory(User::class)->create([
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'password' => $this->password = $this->faker->password(8),
        ]);
    }

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
        $response = $this->postJson(route('auth.login'), [
            'email' => $this->user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_returns_a_token_if_credentials_do_match()
    {
        $response = $this->postJson(route('auth.login'), [
            'email' => $this->user->email,
            'password' => $this->password,
        ]);

        $response->assertSuccessful();
        
        $response->assertJsonStructure(['meta' => ['token']]);
    }

    /** @test */
    public function it_returns_a_user_if_credentials_do_match()
    {
        $response = $this->postJson(route('auth.login'), [
            'email' => $this->user->email,
            'password' => $this->password,
        ]);

        $response->assertSuccessful();

        $response->assertJsonFragment([
            'name' => $this->user->name,
            'email' => $this->user->email,
        ]);
    }
}
