<?php

use PHPUnit\Framework\TestCase;
use Roma\Task3\Product;
use Roma\Task3\Cart;
use Roma\Task3\Exceptions\ItemOutOfStockException;
use Roma\Task3\Exceptions\CartLimitExceededException;

class CartTest extends TestCase
{
  public function testAddItemToCart()
  {
    $product = new Product('клавиатура', 5499, 52);
    $cart = new Cart();
    $cart->addItem($product, 2);
    $this->assertEquals(50, $product->getStock());
  }
  public function testItemOutOfStockException()
  {
    $this->expectException(ItemOutOfStockException::class);
    $product = new Product('клавиатура', 5499, 1);
    $cart = new Cart();
    $cart->addItem($product, 2);
  }
  public function testCartLimitExceededException()
  {
    $this->expectException(CartLimitExceededException::class);
    $cart = new Cart(1);
    $keyboards = new Product('клавиатура', 5499, 10);
    $mouses = new Product('мышка', 3499, 5);
    $cart->addItem($keyboards, 1);
    $cart->addItem($mouses, 1);
  }
}
