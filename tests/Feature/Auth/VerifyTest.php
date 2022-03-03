<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;

class VerifyTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->unverifiedUser = User::factory()->unverified()->create();
    }
    
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->postJson(route('auth.verify'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_fails_if_no_token_is_provided_in_the_request()
    {
        $response = $this->postJsonAs($this->unverifiedUser, route('auth.verify'));

        $response->assertJsonValidationErrors(['token']);
    }

    /** @test */
    public function it_fails_if_tokens_do_not_match()
    {
        $response = $this->postJsonAs($this->unverifiedUser, route('auth.verify'), [
            'token' => 'something-else'
        ]);

        $response->assertJsonValidationErrors(['token']);
    }

    /** @test */
    public function it_can_verify_a_user()
    {
        $response = $this->postJsonAs($this->unverifiedUser, route('auth.verify'), [
            'token' => $this->unverifiedUser->confirmation_token
        ]);

        $response->assertSuccessful();

        $this->assertNotNull($this->unverifiedUser->fresh()->email_verified_at);
        $this->assertNull($this->unverifiedUser->fresh()->confirmation_token);
    }
}
