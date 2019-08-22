<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use App\Events\Users\AccountEmailUpdated;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Resources\Users\PrivateUserResource;
use App\Mail\Account\EmailAddressVerificationEmail;

class UserAccountUpdateTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->patchJson(route('user.account.update', $this->user->id));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_updates_a_users_account_name()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'name' => $name = $this->faker->name
        ]);

        $response->assertSuccessful();

        $this->assertEquals($name, $this->user->fresh()->name);
    }

    /** @test */
    public function it_updates_a_users_email_address()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'email' => $email = $this->faker->safeEmail
        ]);

        $response->assertSuccessful();

        $this->assertEquals($email, $this->user->fresh()->email);
    }

    /** @test */
    public function it_updates_both_a_users_account_name_and_email_address()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'name' => $name = $this->faker->name,
            'email' => $email = $this->faker->safeEmail
        ]);

        $response->assertSuccessful();

        $this->user = $this->user->fresh();
        
        $this->assertEquals($name, $this->user->name);
        
        $this->assertEquals($email, $this->user->email);
    }

    /** @test */
    public function it_sets_the_email_verified_at_column_to_null_when_a_user_updates_his_email_address()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'email' => $this->faker->safeEmail
        ]);

        $response->assertSuccessful();

        $this->assertFalse($this->user->fresh()->isVerified());
    }

    /** @test */
    public function it_generates_a_confirmation_token_when_a_user_updates_his_email_address()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'email' => $this->faker->safeEmail
        ]);

        $response->assertSuccessful();

        $this->assertNotNull($this->user->fresh()->getConfirmationToken());
    }

    /** @test */
    public function it_fires_an_account_email_updated_event_when_a_user_updates_his_email_address()
    {
        Event::fake();
        
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'email' => $this->faker->safeEmail
        ]);

        $response->assertSuccessful();

        Event::assertDispatched(AccountEmailUpdated::class, function ($event) {
            return $event->user->email === $this->user->fresh()->email;
        });
    }

    /** @test */
    public function it_queues_a_verification_email_when_a_user_updates_his_email_address()
    {
        Mail::fake();
        
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'email' => $this->faker->safeEmail
        ]);

        $response->assertSuccessful();

        Mail::assertQueued(EmailAddressVerificationEmail::class, function ($mail) {
            return $mail->hasTo($this->user->fresh()->email);
        });
    }

    /** @test */
    public function it_returns_a_user_resource()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'email' => $this->faker->safeEmail
        ]);

        $response->assertSuccessful();

        $response->assertResource(new PrivateUserResource($this->user->fresh()));
    }
}
