<?php

namespace Tests\Unit\Listeners;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Events\Users\AccountCreated;
use App\Events\Users\AccountEmailUpdated;
use App\Listeners\Users\SendVerificationEmail;
use App\Mail\Account\EmailAddressVerificationEmail;

class SendVerificationEmailListenerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function it_queues_up_an_account_registration_verification_email()
    {
        Mail::fake();

        $event = new AccountCreated($this->user, 'fr');

        $listener = new SendVerificationEmail();
        $listener->handle($event);

        Mail::assertQueued(EmailAddressVerificationEmail::class, function ($mail) {
            return $mail->event->user->email === $this->user->email;
        });
    }

    /** @test */
    public function it_queues_up_a_verification_email_when_user_updates_his_email_address()
    {
        Mail::fake();

        $event = new AccountEmailUpdated($this->user, 'fr');

        $listener = new SendVerificationEmail();
        $listener->handle($event);

        Mail::assertQueued(EmailAddressVerificationEmail::class, function ($mail) {
            return $mail->event->user->email === $this->user->email;
        });
    }
}
