<?php

namespace Tests\Feature\Passwords;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Events\Users\AccountPasswordUpdated;
use Illuminate\Foundation\Testing\WithFaker;
use App\Mail\Password\ForgotPasswordRequestEmail;
use Illuminate\Support\Facades\Event;

class ResetPasswordTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create([
            'email' => $this->email = $this->faker->safeEmail
        ]);
    }

    /** @test */
    public function it_fails_if_authenticated()
    {
        $response = $this->postJsonAs($this->user, route('auth.reset'));
        
        $response->assertUnauthorized();
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
    public function it_requires_a_password_of_at_least_8_characters()
    {
        $response = $this->postJson(route('auth.reset'), [
            'password' => $password = $this->faker->password(7, 7),
            'password_confirmation' => $password
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
            'password' => $this->faker->password(8),
            'password_confirmation' => 'something-else'
        ]);

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function it_resets_passwords()
    {
        Mail::fake();

        $this->postJson(route('auth.forgot'), [
            'email' => $this->user->email
        ]);

        $token = '';

        Mail::assertQueued(ForgotPasswordRequestEmail::class, function ($mail) use (&$token) {
            $token = $mail->token;
            return true;
        });

        $this->assertNotEmpty(DB::table('password_resets')->get());

        $this->postJson(route('auth.reset'), [
            'email' => $this->email,
            'password' => $password = 'password',
            'password_confirmation' => 'password',
            'token' => $token
        ]);

        $this->assertTrue(Hash::check($password, $this->user->fresh()->password));
        
        $this->assertEmpty(DB::table('password_resets')->get());
    }

    /** @test */
    public function it_responds_with_a_200_status_code_when_successful()
    {
        Mail::fake();

        $this->postJson(route('auth.forgot'), [
            'email' => $this->user->email
        ]);

        $token = '';

        Mail::assertQueued(ForgotPasswordRequestEmail::class, function ($mail) use (&$token) {
            $token = $mail->token;
            return true;
        });

        $response = $this->postJson(route('auth.reset'), [
            'email' => $this->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => $token
        ]);

        $response->assertOk();
    }

    /** @test */
    public function it_fails_if_the_token_is_invalid()
    {
        Mail::fake();

        $this->postJson(route('auth.forgot'), [
            'email' => $this->user->email
        ]);

        $response = $this->postJson(route('auth.reset'), [
            'email' => $this->email,
            'password' => 'password',
            'password_confirmation' => 'password',
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
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => 'something-wrong'
        ]);

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_sends_a_confirmation_email_after_the_password_has_been_reset()
    {
        Mail::fake();
        Event::fake(AccountPasswordUpdated::class);

        $this->postJson(route('auth.forgot'), [
            'email' => $this->user->email
        ]);

        $token = '';

        Mail::assertQueued(ForgotPasswordRequestEmail::class, function ($mail) use (&$token) {
            $token = $mail->token;
            return true;
        });

        $this->postJson(route('auth.reset'), [
            'email' => $this->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => $token
        ]);

        Event::assertDispatched(AccountPasswordUpdated::class, function ($event) {
            return $event->user->id === $this->user->id;
        });
    }
}
