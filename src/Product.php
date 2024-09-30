<?php

namespace Roma\Task3;

use Roma\Task3\Exceptions\OutOfStockException;

class Product
{
  private string $name;
  private float $price;
  private int $stock;

  public function __construct(string $name, float $price, int $stock)
  {
    $this->name = $name;
    $this->price = $price;
    $this->stock = $stock;
  }

  public function getName()
  {
    return $this->name;
  }
  public function getPrice()
  {
    return $this->price;
  }
  public function getStock()
  {
    return $this->stock;
  }

  public function reduceStock($quantity)
  {
    try {
      if (($this->stock - $quantity) < 0) {
        throw new OutOfStockException('Недостаточно товара');
      }
      $this->stock -= $quantity;
    } catch (OutOfStockException $e) {
      print $e->getMessage() . PHP_EOL;
    }
  }
}
