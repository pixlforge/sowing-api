<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;

class MeTest extends TestCase
{
    /** @test */
    public function it_fails_if_user_is_not_authenticated()
    {
        $response = $this->getJson(route('auth.me'));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_returns_user_details()
    {
        $user = factory(User::class)->create();

        $response = $this->getJsonAs($user, route('auth.me'));

        $response->assertJsonFragment([
            'email' => $user->email
        ]);
    }
}
