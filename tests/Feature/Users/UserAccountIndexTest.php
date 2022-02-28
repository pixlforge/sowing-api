<?php

namespace Tests\Feature\Users;

use Tests\TestCase;
use App\Models\User;
use App\Http\Resources\Users\PrivateUserResource;

class UserAccountIndexTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->getJson(route('user.account.index'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_returns_a_user_resource()
    {
        $user = User::factory()->create();

        $response = $this->getJsonAs($user, route('user.account.index'));

        $response->assertResource(PrivateUserResource::make($user));
    }
}
