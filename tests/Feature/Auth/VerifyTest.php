<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;

class VerifyTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->postJson(route('auth.verify'));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_fails_if_no_token_is_provided_in_the_request()
    {
        $user = factory(User::class)->states('unverified')->create();

        $response = $this->postJsonAs($user, route('auth.verify'));

        $response->assertJsonValidationErrors(['token']);
    }

    /** @test */
    public function it_fails_if_tokens_do_not_match()
    {
        $user = factory(User::class)->states('unverified')->create();

        $response = $this->postJsonAs($user, route('auth.verify'), [
            'token' => 'something-else'
        ]);

        $response->assertJsonValidationErrors(['token']);
    }

    /** @test */
    public function it_can_verify_a_user()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->states(['unverified'])->create();

        $response = $this->postJsonAs($user, route('auth.verify'), [
            'token' => $user->confirmation_token
        ]);

        $response->assertSuccessful();

        $this->assertNotNull($user->fresh()->email_verified_at);
        $this->assertNull($user->fresh()->confirmation_token);
    }
}
