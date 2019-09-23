<?php

namespace Tests\Feature\Newsletters;

use Mockery;
use Tests\TestCase;
use Spatie\Newsletter\NewsletterFacade;
use Illuminate\Foundation\Testing\WithFaker;

class SubscriberStoreTest extends TestCase
{
    use WithFaker;

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

    /** @test */
    public function it_can_subscribe_to_the_newsletter()
    {
        $email = $this->faker->safeEmail;

        $mock = Mockery::mock();
        $mock->shouldReceive('subscribeOrUpdate')
            ->with($email);

        NewsletterFacade::swap($mock);

        $response = $this->postJson(route('newsletter.subscriber.store'), [
            'email' => $email
        ]);

        $response->assertOk();
    }
}
