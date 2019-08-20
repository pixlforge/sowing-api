<?php

namespace Tests\Feature\Shops;

use Tests\TestCase;
use App\Models\User;
use App\Models\Shop;

class ShopCheckerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }
    
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->postJson(route('shop.checker'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_passes_when_the_name_is_available()
    {
        $response = $this->postJsonAs($this->user, route('shop.checker'), [
            'name' => 'My Awesome Shop'
        ]);

        $response->assertSuccessful();
    }

    /** @test */
    public function it_fails_when_the_name_is_unavailable()
    {
        factory(Shop::class)->create([
            'name' => 'My Awesome Shop'
        ]);

        $response = $this->postJsonAs($this->user, route('shop.checker'), [
            'name' => 'My Awesome Shop'
        ]);

        $response->assertStatus(409);
    }
}
