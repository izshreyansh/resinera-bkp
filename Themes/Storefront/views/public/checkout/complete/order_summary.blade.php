<aside class="order-summary-wrap">
    <div class="order-summary">
        <div class="order-summary-top">
            <h3 class="section-title">{{ trans('storefront::cart.order_summary') }}</h3>

            <ul class="list-inline cart-item">
                <li v-for="cartItem in cart_after_order_success.items">
                    <label>
                        <a :href="productUrl(cartItem.product)" class="product-name" v-text="cartItem.product.name"></a>
                        <span class="product-quantity" v-text="'x' + cartItem.qty"></span>
                    </label>

                    <span class="price-amount" v-html="cartItem.unitPrice.inCurrentCurrency.formatted"></span>
                </li>
            </ul>
        </div>

        <div class="order-summary-middle" :class="{ loading: loadingOrderSummary }">
            <ul class="list-inline order-summary-list">
                <li>
                    <label>{{ trans('storefront::cart.subtotal') }}</label>

                    <span
                        class="price-amount"
                        v-html="cart_after_order_success.subTotal.inCurrentCurrency.formatted"
                    >
                    </span>
                </li>

                <li v-for="tax in cart_after_order_success.taxes">
                    <label v-text="tax.name"></label>

                    <span
                        class="price-amount"
                        v-html="tax.amount.inCurrentCurrency.formatted"
                    >
                    </span>
                </li>

                <li v-if="hasCoupon" v-cloak>
                    <label>
                        {{ trans('storefront::cart.coupon') }}

                        <span class="coupon-code">
                            [@{{ cart_after_order_success.coupon.code }}]
                            <span class="btn-remove-coupon" @click="removeCoupon">
                                <i class="las la-times"></i>
                            </span>
                        </span>
                    </label>

                    <span
                        class="price-amount"
                        v-html="'-' + cart_after_order_success.coupon.value.inCurrentCurrency.formatted"
                    >
                    </span>
                </li>
            </ul>

            <!-- <div class="shipping-methods" v-if="hasShippingMethod" v-cloak> -->
            <div class="shipping-methods" v-cloak>
                <h6>{{ trans('storefront::cart.shipping_method') }}</h6>

                <div class="form-group">
                    <div class="form-radio" v-for="shippingMethod in cart_after_order_success.availableShippingMethods">
                        <label :for="shippingMethod.name" v-text="shippingMethod.label + ' (' +  {{session()->get('totalWeight')}} + 'g)'"></label>

                        <span
                            class="price-amount"
                            v-html="'{{session()->get('totalShippingCharge')->toArray()['formatted']}}'"
                        >
                        </span>
                    </div>
                </div>
            </div>

            <div class="order-summary-total">
                <label>{{ trans('storefront::cart.total') }}</label>
                <span class="total-price" v-html="cart_after_order_success.total.inCurrentCurrency.formatted"></span>
            </div>
        </div>
    </div>
</aside>
