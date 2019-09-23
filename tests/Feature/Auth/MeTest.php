<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use App\Http\Resources\Users\PrivateUserResource;

class MeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function it_fails_if_user_is_not_authenticated()
    {
        $response = $this->getJson(route('auth.me'));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_returns_user_details()
    {
        $response = $this->getJsonAs($this->user, route('auth.me'));

        $response->assertJsonFragment([
            'email' => $this->user->email
        ]);
    }

    /** @test */
    public function it_returns_a_private_user_resource()
    {
        $response = $this->getJsonAs($this->user, route('auth.me'));

        $response->assertResource(PrivateUserResource::make($this->user));
    }
}
