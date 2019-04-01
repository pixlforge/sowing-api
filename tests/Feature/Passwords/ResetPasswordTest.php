<?php

namespace Tests\Feature\Passwords;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use App\Events\Passwords\PasswordReset;
use App\Mail\Password\ForgotPasswordRequestEmail;
use App\Mail\Password\PasswordResetConfirmationEmail;

class ResetPasswordTest extends TestCase
{
    /** @test */
    public function it_fails_if_authenticated()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('auth.reset'));
        
        $response->assertStatus(401);
    }

    /** @test */
    public function it_requires_an_email()
    {
        $response = $this->postJson(route('auth.reset'));

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_requires_a_valid_email()
    {
        $response = $this->postJson(route('auth.reset'), [
            'email' => 'something-wrong'
        ]);

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_requires_a_token()
    {
        $response = $this->postJson(route('auth.reset'));

        $response->assertJsonValidationErrors(['token']);
    }

    /** @test */
    public function it_requires_a_password()
    {
        $response = $this->postJson(route('auth.reset'));

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function it_requires_a_password_of_at_least_6_characters()
    {
        $response = $this->postJson(route('auth.reset'), [
            'password' => 'abc',
            'password_confirmation' => 'abc'
        ]);

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function it_requires_a_password_confirmation()
    {
        $response = $this->postJson(route('auth.reset'));

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function it_requires_passwords_to_match()
    {
        $response = $this->postJson(route('auth.reset'), [
            'password' => 'something',
            'password_confirmation' => 'something-else'
        ]);

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function it_resets_passwords()
    {
        Mail::fake();
        Event::fake();

        $user = factory(User::class)->create([
            'email' => $email = 'john@example.com'
        ]);

        $this->postJson(route('auth.forgot'), [
            'email' => $user->email
        ]);

        $token = '';

        Mail::assertQueued(ForgotPasswordRequestEmail::class, function ($mail) use (&$token) {
            $token = $mail->token;
            return true;
        });

        $this->assertNotEmpty(DB::table('password_resets')->get());

        $this->postJson(route('auth.reset'), [
            'email' => $email,
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'token' => $token
        ]);

        Event::assertDispatched(PasswordReset::class);
        $this->assertEmpty(DB::table('password_resets')->get());
    }

    /** @test */
    public function it_responds_with_a_200_status_code_when_successful()
    {
        Mail::fake();

        $user = factory(User::class)->create([
            'email' => $email = 'john@example.com'
        ]);

        $this->postJson(route('auth.forgot'), [
            'email' => $user->email
        ]);

        $token = '';

        Mail::assertQueued(ForgotPasswordRequestEmail::class, function ($mail) use (&$token) {
            $token = $mail->token;
            return true;
        });

        $response = $this->postJson(route('auth.reset'), [
            'email' => $email,
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'token' => $token
        ]);

        $response->assertOk();
    }

    /** @test */
    public function it_fails_if_the_token_is_invalid()
    {
        Mail::fake();

        $user = factory(User::class)->create([
            'email' => $email = 'john@example.com'
        ]);

        $this->postJson(route('auth.forgot'), [
            'email' => $user->email
        ]);

        $response = $this->postJson(route('auth.reset'), [
            'email' => $email,
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'token' => 'something-wrong'
        ]);

        $response->assertJsonValidationErrors(['token']);
    }

    /** @test */
    public function it_fails_if_the_email_cannot_be_found()
    {
        Mail::fake();

        $response = $this->postJson(route('auth.reset'), [
            'email' => 'inexistent-email',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'token' => 'something-wrong'
        ]);

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_sends_a_confirmation_email_after_the_password_has_been_reset()
    {
        Mail::fake();

        $user = factory(User::class)->create([
            'email' => $email = 'john@example.com'
        ]);

        $this->postJson(route('auth.forgot'), [
            'email' => $user->email
        ]);

        $token = '';

        Mail::assertQueued(ForgotPasswordRequestEmail::class, function ($mail) use (&$token) {
            $token = $mail->token;
            return true;
        });

        $this->postJson(route('auth.reset'), [
            'email' => $email,
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'token' => $token
        ]);

        Mail::assertQueued(PasswordResetConfirmationEmail::class, function ($mail) use ($user) {
            return $mail->event->user->email === $user->email;
        });
    }
}
