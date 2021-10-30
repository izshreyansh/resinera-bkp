<?php

namespace Modules\Cart;

use Modules\Setting\Entities\Setting;
use Modules\Support\Money;

class CartShippingMethod
{
    private $cart;
    private $shippingMethodCondition;

    public function __construct($cart, $shippingMethodCondition)
    {
        $this->cart = $cart;
        $this->shippingMethodCondition = $shippingMethodCondition;
    }

    public function name()
    {
        return $this->shippingMethodCondition->getAttribute('shipping_method')->name;
    }

    public function label()
    {
        return $this->shippingMethodCondition->getAttribute('shipping_method')->label;
    }

    public function cost()
    {
        return Money::inDefaultCurrency($this->calculate());
    }

    private function calculate()
    {
        if($this->shippingMethodCondition->getAttribute('shipping_method')->name == 'flat_rate') {
            if($this->cart->totalWeight() <= 500) {
                return (float) Setting::get('flat_rate_below_500_cost');
            } else if($this->cart->totalWeight() > 500 && $this->cart->totalWeight() <= 2000) {
                return (float) Setting::get('flat_rate_below_2000_cost');
            } else if( $this->cart->totalWeight() > 2000 ) {
                return (float) Setting::get('flat_rate_above_2000_cost');
            }
        }

        return $this->shippingMethodCondition->getCalculatedValue($this->cart->subTotal()->amount());
    }
}
