<?php

namespace Tests\Feature\Password;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use App\Mail\Password\ForgotPasswordRequestEmail;

class ForgotPasswordTest extends TestCase
{
    use WithFaker;
    
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }
    
    /** @test */
    public function it_fails_if_authenticated()
    {
        $response = $this->postJsonAs($this->user, route('auth.forgot'));
        
        $response->assertUnauthorized();
    }

    /** @test */
    public function it_requires_an_email()
    {
        $response = $this->postJson(route('auth.forgot'));

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_requires_a_valid_email()
    {
        $response = $this->postJson(route('auth.forgot'), [
            'email' => 'something-wrong'
        ]);

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_fails_if_the_email_does_not_exist()
    {
        Mail::fake();

        $this->postJson(route('auth.forgot'), [
            'email' => $this->faker->safeEmail
        ]);

        Mail::assertNotQueued(ForgotPasswordRequestEmail::class);
    }

    /** @test */
    public function it_sends_an_email()
    {
        Mail::fake();

        $this->postJson(route('auth.forgot'), [
            'email' => $this->user->email
        ]);

        Mail::assertQueued(ForgotPasswordRequestEmail::class, function ($mail) {
            return $mail->user->email === $this->user->email;
        });
    }

    /** @test */
    public function it_responds_with_a_200_status_code_when_successful()
    {
        Mail::fake();

        $response = $this->postJson(route('auth.forgot'), [
            'email' => $this->user->email
        ]);

        $response->assertOk();
    }

    /** @test */
    public function it_responds_with_a_422_status_code_when_it_fails()
    {
        $response = $this->postJson(route('auth.forgot'), [
            'email' => $this->faker->safeEmail
        ]);

        $response->assertStatus(422);
    }
}
