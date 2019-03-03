<?php

namespace Tests\Unit\Listeners;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Events\Users\AccountCreated;
use App\Listeners\Users\SendConfirmationEmail;
use App\Mail\Account\AccountCreationConfirmationEmail;

class SendConfirmationEmailListenerTest extends TestCase
{
    /** @test */
    public function it_queues_up_an_account_registration_confirmation_email()
    {
        Mail::fake();

        $user = factory(User::class)->create([
            'email' => $email = 'john@example.com'
        ]);

        $event = new AccountCreated($user, 'fr');

        $listener = new SendConfirmationEmail();
        $listener->handle($event);

        Mail::assertQueued(AccountCreationConfirmationEmail::class, function ($mail) use ($email) {
            return $mail->event->user->email === $email;
        });
    }
}
