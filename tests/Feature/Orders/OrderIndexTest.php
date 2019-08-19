<?php

namespace Tests\Feature\Orders;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;

class OrderIndexTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->user->orders()->save(
            $this->order = factory(Order::class)->make()
        );
    }
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->getJson(route('orders.index'));

        $response->assertUnauthorized();
    }

    /** @test */
    public function it_returns_a_collection_of_orders()
    {
        $response = $this->getJsonAs($this->user, route('orders.index'));

        $response->assertJsonFragment([
            'id' => $this->order->id
        ]);
    }

    /** @test */
    public function it_orders_by_the_latest_first()
    {
        $anotherOrder = factory(Order::class)->create([
            'user_id' => $this->user->id,
            'created_at' => now()->subDay()
        ]);

        $response = $this->getJsonAs($this->user, route('orders.index'));

        $response->assertSeeInOrder([
            $this->order->created_at->toDateTimeString(),
            $anotherOrder->created_at->toDateTimeString(),
        ]);
    }

    /** @test */
    public function it_has_pagination()
    {
        $response = $this->getJsonAs($this->user, route('orders.index'));

        $response->assertJsonStructure(['links', 'meta']);
    }
}
