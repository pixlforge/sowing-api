<?php

namespace Tests\Feature\Newsletters;

use Tests\TestCase;

class SubscriberStoreTest extends TestCase
{
    /** @test */
    public function it_requires_an_email()
    {
        $response = $this->postJson(route('newsletter.subscriber.store'));

        $response->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_requires_a_valid_email()
    {
        $response = $this->postJson(route('newsletter.subscriber.store'), [
            'email' => 'nope'
        ]);

        $response->assertJsonValidationErrors(['email']);
    }
}
