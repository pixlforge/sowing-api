<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use App\Events\Users\AccountEmailUpdated;
use App\Events\Users\AccountPasswordUpdated;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Resources\Users\PrivateUserResource;

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
    public function it_requires_a_non_empty_name()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'name' => ''
        ]);

        $response->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function it_requires_a_name_in_string_format()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'name' => 123
        ]);

        $response->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function it_requires_a_name_with_a_minimum_length_of_2_characters()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'name' => str_repeat('a', 1)
        ]);

        $response->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function it_requires_a_name_with_a_maximum_length_of_255_characters()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'name' => str_repeat('a', 256)
        ]);

        $response->assertJsonValidationErrors(['name']);
    }

    /** @test */
    public function it_requires_a_non_empty_email()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'email' => ''
        ]);

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_requires_a_valid_email()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'email' => 'something-wrong'
        ]);

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_requires_a_unique_email()
    {
        factory(User::class)->create([
            'email' => $email = $this->faker->safeEmail
        ]);

        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'id' => $this->user->id,
            'email' => $email
        ]);

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_requires_a_non_empty_password()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'password' => ''
        ]);

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function it_requires_a_password_in_string_format()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'password' => 12345678
        ]);

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function it_requires_a_non_empty_password_confirmation()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'password' => $this->faker->password(8),
            'password_confirmation' => ''
        ]);

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function it_requires_a_password_with_a_minimum_length_of_8_characters()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'password' => $password = $this->faker->password(7, 7),
            'password_confirmation' => $password
        ]);

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function it_requires_a_password_with_a_maximum_length_of_255_characters()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'password' => $password = $this->faker->password(256, 256),
            'password_confirmation' => $password
        ]);

        $response->assertJsonValidationErrors(['password']);
    }

    /** @test */
    public function it_updates_a_users_account_name()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'name' => $name = $this->faker->name
        ]);

        $response->assertOk();

        $this->assertEquals($name, $this->user->fresh()->name);
    }

    /** @test */
    public function it_updates_a_users_email_address()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'email' => $email = $this->faker->safeEmail
        ]);

        $response->assertOk();

        $this->assertEquals($email, $this->user->fresh()->email);
    }

    /** @test */
    public function it_updates_a_users_email_using_the_same_email_address()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'id' => $this->user->id,
            'email' => $email = $this->user->email
        ]);

        $response->assertOk();

        $this->assertEquals($email, $this->user->fresh()->email);
    }

    /** @test */
    public function it_updates_a_users_password()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'password' => $password = $this->faker->password(8),
            'password_confirmation' => $password
        ]);

        $response->assertOk();

        $this->assertTrue(Hash::check($password, $this->user->fresh()->password));
    }

    /** @test */
    public function it_sets_the_email_verified_at_column_to_null_when_a_user_updates_his_email_address()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'email' => $this->faker->safeEmail
        ]);

        $response->assertOk();

        $this->assertFalse($this->user->fresh()->isVerified());
    }

    /** @test */
    public function it_generates_a_confirmation_token_when_a_user_updates_his_email_address()
    {
        $this->withoutExceptionHandling();
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'email' => $this->faker->safeEmail
        ]);

        $response->assertOk();

        $this->assertNotNull($this->user->fresh()->getConfirmationToken());
    }

    /** @test */
    public function it_fires_an_account_email_updated_event_when_a_user_updates_his_email_address()
    {
        Event::fake(AccountEmailUpdated::class);
        
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'email' => $this->faker->safeEmail
        ]);

        $response->assertOk();

        Event::assertDispatched(AccountEmailUpdated::class, function ($event) {
            return $event->user->email === $this->user->fresh()->email;
        });
    }

    /** @test */
    public function it_fires_an_account_password_upated_event_when_a_user_updates_his_password()
    {
        Event::fake(AccountPasswordUpdated::class);

        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'password' => $password = $this->faker->password(8),
            'password_confirmation' => $password
        ]);

        $response->assertOk();

        Event::assertDispatched(AccountPasswordUpdated::class, function ($event) {
            return $event->user->email === $this->user->email;
        });
    }

    /** @test */
    public function it_returns_a_user_resource()
    {
        $response = $this->patchJsonAs($this->user, route('user.account.update'), [
            'email' => $this->faker->safeEmail
        ]);

        $response->assertOk();

        $response->assertResource(PrivateUserResource::make($this->user->fresh()));
    }
}
