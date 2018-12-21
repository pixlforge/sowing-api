<?php

namespace Tests\Unit\Collections;

use Tests\TestCase;
use App\Models\User;
use App\Models\Variation;
use App\Models\Collections\VariationCollection;

class VariationCollectionTest extends TestCase
{
    /** @test */
    public function it_can_get_a_syncing_product_variations_array()
    {
        $user = factory(User::class)->create();

        $user->cart()->attach(
            $variation = factory(Variation::class)->create(),
            ['quantity' => $quantity = 5]
        );

        $collection = new VariationCollection($user->cart);

        $this->assertEquals([
            $variation->id => [
                'quantity' => $quantity
            ]
        ], $collection->forSyncing());
    }
}
