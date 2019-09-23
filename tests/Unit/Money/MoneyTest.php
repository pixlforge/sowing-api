<?php

namespace Tests\Unit\Money;

use Tests\TestCase;
use App\Money\Money;
use Money\Money as BaseMoney;

class MoneyTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->money = new Money(1000);
    }
    
    /** @test */
    public function it_can_get_the_absolute_amount()
    {
        $this->assertEquals('1000', $this->money->getAmount());
    }

    /** @test */
    public function it_can_get_the_detailed_amount()
    {
        $this->assertEquals(
            '10.00',
            $this->money->detailed()['amount']
        );
    }

    /** @test */
    public function it_can_get_the_formatted_amount()
    {
        $this->assertEquals(
            (new Money(1000))->formatted(),
            $this->money->formatted()
        );
    }

    /** @test */
    public function it_can_add_up()
    {
        $this->money = $this->money->add(new Money(1000));

        $this->assertEquals(2000, $this->money->getAmount());
    }

    /** @test */
    public function it_can_return_the_underlying_instance()
    {
        $this->assertInstanceOf(BaseMoney::class, $this->money->instance());
    }
}
