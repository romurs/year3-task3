<?php

use PHPUnit\Framework\TestCase;
use Roma\Task3\Product;
use Roma\Task3\Checkout;
use Roma\Task3\Cart;

class ProductTest extends TestCase
{
  public function testReduceStock()
  {
    $product = new Product('клавиатура', 5499, 10);
    $product->reduceStock(2);
    $this->assertEquals(8, $product->getStock());
  }
}
