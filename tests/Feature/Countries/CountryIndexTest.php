<?php

namespace Tests\Feature\Countries;

use Tests\TestCase;
use App\Models\Country;

class CountryIndexTest extends TestCase
{
    /** @test */
    public function it_returns_a_list_of_countries()
    {
        $country = factory(Country::class)->create();

        $response = $this->getJson(route('countries.index'));

        $response->assertJsonFragment([
            'id' => $country->id
        ]);
    }
}
