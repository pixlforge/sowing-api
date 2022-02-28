<?php

namespace Tests\Unit\Listeners;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Events\Users\AccountPasswordUpdated;
use App\Mail\Account\PasswordUpdateConfirmationEmail;
use App\Listeners\Users\SendPasswordUpdateConfirmationEmail;

class SendPasswordUpdateConfirmationEmailListenerTest extends TestCase
{
    /** @test */
    public function it_queues_up_a_confirmation_email_when_user_updates_his_password()
    {
        Mail::fake();

        $user = User::factory()->create();

        $event = new AccountPasswordUpdated($user, 'fr');

        $listener = new SendPasswordUpdateConfirmationEmail();
        $listener->handle($event);

        Mail::assertQueued(PasswordUpdateConfirmationEmail::class, function ($mail) use ($user) {
            return $mail->event->user->email === $user->email &&
                $mail->hasTo($user->email);
        });
    }
}
