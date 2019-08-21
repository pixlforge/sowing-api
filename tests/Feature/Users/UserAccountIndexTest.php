<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use App\Models\User;

class UserAccountIndexTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->getJson(route('user.account.index'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_returns_user_details()
    {
        $user = factory(User::class)->create();

        $response = $this->getJsonAs($user, route('user.account.index'));

        $response->assertJsonFragment([
            'email' => $user->email
        ]);
    }
}
