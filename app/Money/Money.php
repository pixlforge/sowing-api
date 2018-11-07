<?php

namespace App\Money;

use Money\Currency;
use NumberFormatter;
use Money\Money as BaseMoney;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;

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

    public function amount()
    {
        return $this->money->getAmount();
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
}
