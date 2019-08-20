<?php

namespace Tests\Unit\Listeners;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Events\Passwords\PasswordReset;
use App\Mail\Password\PasswordResetConfirmationEmail;
use App\Listeners\Passwords\SendPasswordResetConfirmationEmail;

class SendPasswordResetConfirmationEmailListenerTest extends TestCase
{
    /** @test */
    public function it_queues_up_a_password_reset_confirmation_email()
    {
        Mail::fake();

        $user = factory(User::class)->create([
            'email' => $email = 'john@example.com'
        ]);

        $event = new PasswordReset($user, 'fr');

        $listener = new SendPasswordResetConfirmationEmail();
        $listener->handle($event);

        Mail::assertQueued(PasswordResetConfirmationEmail::class, function ($mail) use ($email) {
            return $mail->event->user->email === $email;
        });
    }
}
