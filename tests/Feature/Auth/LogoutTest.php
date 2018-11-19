<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;

class LogoutTest extends TestCase
{
    /** @test */
    public function it_fails_if_user_is_not_authenticated()
    {
        $response = $this->postJson(route('auth.logout'));

        $response->assertStatus(401);
    }

    /** @test */
    public function authenticated_users_can_log_out()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('auth.logout'));

        $response->assertSuccessful();
    }
}
