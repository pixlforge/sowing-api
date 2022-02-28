<?php

namespace Tests\Feature\Orders;

use App\Http\Resources\Orders\OrderResource;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;

class OrderIndexTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->user->orders()->save(
            $this->order = Order::factory()->make()
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

        $response->assertResource(OrderResource::collection($this->user->orders));
    }

    /** @test */
    public function it_orders_by_the_latest_first()
    {
        $anotherOrder = Order::factory()->create([
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
