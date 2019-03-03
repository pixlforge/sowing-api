<?php

namespace Tests\Unit\Listeners;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Events\Users\AccountCreated;
use App\Listeners\Users\SendVerificationEmail;
use App\Mail\Account\AccountCreationVerificationEmail;

class SendVerificationEmailListenerTest extends TestCase
{
    /** @test */
    public function it_queues_up_an_account_registration_verification_email()
    {
        Mail::fake();

        $user = factory(User::class)->create([
            'email' => $email = 'john@example.com'
        ]);

        $event = new AccountCreated($user, 'fr');

        $listener = new SendVerificationEmail();
        $listener->handle($event);

        Mail::assertQueued(AccountCreationVerificationEmail::class, function ($mail) use ($email) {
            return $mail->event->user->email === $email;
        });
    }
}
