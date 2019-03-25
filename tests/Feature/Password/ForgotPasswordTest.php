<?php

namespace Tests\Feature\Password;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\Password\ForgotPasswordRequestEmail;

class ForgotPasswordTest extends TestCase
{
    /** @test */
    public function it_fails_if_authenticated()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('auth.forgot'));
        
        $response->assertStatus(401);
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
            'email' => 'john@exampe.com'
        ]);

        Mail::assertNotQueued(ForgotPasswordRequestEmail::class);
    }

    /** @test */
    public function it_sends_an_email()
    {
        Mail::fake();

        $user = factory(User::class)->create();

        $this->postJson(route('auth.forgot'), [
            'email' => $user->email
        ]);

        Mail::assertQueued(ForgotPasswordRequestEmail::class, function ($mail) use ($user) {
            return $mail->user->email === $user->email;
        });
    }

    /** @test */
    public function it_responds_with_a_200_status_code_when_successful()
    {
        Mail::fake();

        $user = factory(User::class)->create();

        $response = $this->postJson(route('auth.forgot'), [
            'email' => $user->email
        ]);

        $response->assertOk();
    }

    /** @test */
    public function it_responds_with_a_200_status_code_when_it_fails()
    {
        $response = $this->postJson(route('auth.forgot'), [
            'email' => 'john@example.com'
        ]);

        $response->assertStatus(422);
    }
}
