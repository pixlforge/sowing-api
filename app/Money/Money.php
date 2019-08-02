<?php

namespace App\Money;

use Money\Currency;
use NumberFormatter;
use Money\Money as BaseMoney;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Formatter\DecimalMoneyFormatter;

class Money
{
    protected $money;

    /**
     * Money constructor.
     *
     * @param $value
     */
    public function __construct($value)
    {
        $this->money = new BaseMoney($value, new Currency('CHF'));
    }

    /**
     * Return the amount.
     *
     * @return integer
     */
    public function amount()
    {
        return $this->money->getAmount();
    }

    /**
     * Returns an array containing the currency and the amount.
     *
     * @return array
     */
    public function raw()
    {
        $formatter = new DecimalMoneyFormatter(new ISOCurrencies());

        return [
            'amount' => $formatter->format($this->money),
            'currency' => $this->money->getCurrency()
        ];
    }

    /**
     * Format the Money instance price attribute.
     *
     * @return string
     */
    public function formatted()
    {
        $formatter = new IntlMoneyFormatter(
            new NumberFormatter('CH', NumberFormatter::CURRENCY),
            new ISOCurrencies()
        );

        return $formatter->format($this->money);
    }

    /**
     * Adds two Money instances.
     *
     * @param Money $money
     * @return $this
     */
    public function add(Money $money)
    {
        $this->money = $this->money->add($money->instance());
        
        return $this;
    }

    /**
     * Returns the underlying Money class instance.
     *
     * @return \Money\Money
     */
    public function instance()
    {
        return $this->money;
    }
}
