<?php

namespace Tests\Feature\Orders;

use Tests\TestCase;
use App\Models\User;
use App\Models\Stock;
use App\Models\Address;
use App\Models\Variation;
use App\Models\ShippingMethod;
use Illuminate\Support\Facades\Event;
use App\Events\Orders\OrderCreated;

class OrderStoreTest extends TestCase
{
    /** @test */
    public function it_fails_if_unauthenticated()
    {
        $response = $this->postJson(route('orders.store'));

        $response->assertStatus(401);
    }

    /** @test */
    public function it_requires_an_address()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('orders.store'));

        $response->assertJsonValidationErrors(['address_id']);
    }

    /** @test */
    public function it_requires_an_address_that_exists()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('orders.store'), [
            'address_id' => 999
        ]);

        $response->assertJsonValidationErrors(['address_id']);
    }

    /** @test */
    public function it_requires_an_address_that_belongs_to_the_authenticated_user()
    {
        $user = factory(User::class)->create();

        $address = factory(Address::class)->create([
            'user_id' => function () {
                return factory(User::class)->create()->id;
            }
        ]);

        $response = $this->postJsonAs($user, route('orders.store'), [
            'address_id' => $address->id
        ]);

        $response->assertJsonValidationErrors(['address_id']);
    }

    /** @test */
    public function it_requires_a_shipping_method()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('orders.store'));

        $response->assertJsonValidationErrors(['shipping_method_id']);
    }

    /** @test */
    public function it_requires_a_shipping_method_that_exists()
    {
        $user = factory(User::class)->create();

        $response = $this->postJsonAs($user, route('orders.store'), [
            'shipping_method_id' => 999
        ]);

        $response->assertJsonValidationErrors(['shipping_method_id']);
    }

    /** @test */
    public function it_requires_a_valid_shipping_method_for_the_address()
    {
        $user = factory(User::class)->create();

        $address = factory(Address::class)->create([
            'user_id' => $user->id
        ]);

        $shippingMethod = factory(ShippingMethod::class)->create();

        $response = $this->postJsonAs($user, route('orders.store'), [
            'address_id' => $address->id,
            'shipping_method_id' => $shippingMethod->id
        ]);

        $response->assertJsonValidationErrors(['shipping_method_id']);
    }

    /** @test */
    public function it_can_create_an_order()
    {
        $user = factory(User::class)->create();

        list($address, $shippingMethod) = $this->getOrderDependencies($user);

        $response = $this->postJsonAs($user, route('orders.store'), [
            'address_id' => $address->id,
            'shipping_method_id' => $shippingMethod->id
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'address_id' => $address->id,
            'shipping_method_id' => $shippingMethod->id,
        ]);
    }

    /** @test */
    public function it_attaches_the_product_variations_to_the_order()
    {
        $user = factory(User::class)->create();

        $user->cart()->sync(
            $variation = $this->getVariationWithStock()
        );

        list($address, $shippingMethod) = $this->getOrderDependencies($user);

        $response = $this->postJsonAs($user, route('orders.store'), [
            'address_id' => $address->id,
            'shipping_method_id' => $shippingMethod->id
        ]);

        $this->assertDatabaseHas('order_variation', [
            'order_id' => $response->getData()->data->id,
            'variation_id' => $variation->id,
        ]);
    }

    /** @test */
    public function it_fails_to_create_an_order_if_the_cart_is_empty()
    {
        $user = factory(User::class)->create();

        list($address, $shippingMethod) = $this->getOrderDependencies($user);

        $this->assertCount(0, $user->orders);
        
        $response = $this->postJsonAs($user, route('orders.store'), [
            'address_id' => $address->id,
            'shipping_method_id' => $shippingMethod->id
        ]);
            
        $response->assertStatus(400);
        $this->assertCount(0, $user->orders);
    }

    /** @test */
    public function it_fires_an_order_created_event_upon_ordering()
    {
        Event::fake();

        $user = factory(User::class)->create();

        $user->cart()->sync(
            $variation = $this->getVariationWithStock()
        );

        list($address, $shippingMethod) = $this->getOrderDependencies($user);

        $response = $this->postJsonAs($user, route('orders.store'), [
            'address_id' => $address->id,
            'shipping_method_id' => $shippingMethod->id
        ]);

        Event::assertDispatched(OrderCreated::class, function ($event) use ($response) {
            return $event->order->id === $response->getData()->data->id;
        });
    }

    /** @test */
    public function it_empties_the_cart_after_an_order_is_created()
    {
        $user = factory(User::class)->create();

        $user->cart()->sync(
            $variation = $this->getVariationWithStock()
        );

        list($address, $shippingMethod) = $this->getOrderDependencies($user);

        $response = $this->postJsonAs($user, route('orders.store'), [
            'address_id' => $address->id,
            'shipping_method_id' => $shippingMethod->id
        ]);

        $response->assertOk();
        $this->assertEmpty($user->cart);
    }

    /**
     * Returns a product variation with stock.
     *
     * @return App\Models\Variation
     */
    public function getVariationWithStock()
    {
        $variation = factory(Variation::class)->create([
            'price' => 5000
        ]);

        factory(Stock::class)->create([
            'variation_id' => $variation->id
        ]);

        return $variation;
    }

    /**
     * Get the dependencies for the order.
     *
     * @param User $user
     * @return array
     */
    protected function getOrderDependencies(User $user)
    {
        $address = factory(Address::class)->create(['user_id' => $user->id]);

        $shippingMethod = factory(ShippingMethod::class)->create();
        $shippingMethod->countries()->attach($address->country);

        return [$address, $shippingMethod];
    }
}
