<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;

class LogoutTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function it_fails_if_user_is_not_authenticated()
    {
        $response = $this->postJson(route('auth.logout'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function authenticated_users_can_log_out()
    {
        $response = $this->postJsonAs($this->user, route('auth.logout'));

        $response->assertSuccessful();
    }
}
