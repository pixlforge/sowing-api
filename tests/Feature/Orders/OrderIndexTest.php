<?php

namespace Tests\Feature\Orders;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;

class OrderIndexTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->getJson(route('orders.index'));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_returns_a_collection_of_orders()
    {
        $user = factory(User::class)->create();

        $order = factory(Order::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->getJsonAs($user, route('orders.index'));

        $response->assertJsonFragment([
            'id' => $order->id
        ]);
    }

    /** @test */
    public function it_orders_by_the_latest_first()
    {
        $user = factory(User::class)->create();

        $order = factory(Order::class)->create([
            'user_id' => $user->id
        ]);

        $anotherOrder = factory(Order::class)->create([
            'user_id' => $user->id,
            'created_at' => now()->subDay()
        ]);

        $response = $this->getJsonAs($user, route('orders.index'));

        $response->assertSeeInOrder([
            $order->created_at->toDateTimeString(),
            $anotherOrder->created_at->toDateTimeString(),
        ]);
    }

    /** @test */
    public function it_has_pagination()
    {
        $user = factory(User::class)->create();

        $response = $this->getJsonAs($user, route('orders.index'));

        $response->assertJsonStructure(['links', 'meta']);
    }
}
