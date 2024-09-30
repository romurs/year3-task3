<?php

use PHPUnit\Framework\TestCase;
use Roma\Task3\Product;
use Roma\Task3\Checkout;
use Roma\Task3\Cart;

class CheckoutTest extends TestCase
{
  public function testProcessPayment()
  {
    $product = new Product("T-shirt", 100, 10);
    $cart = new Cart();
    $cart->addItem($product, 2);

    $checkout = new Checkout($cart, 'банковская карта', 74000);

    $this->expectNotToPerformAssertions();
    $checkout->finalizeOrder();
  }
}
