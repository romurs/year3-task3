<?php

namespace Roma\Task3;

use Roma\Task3\Product;
use Roma\Task3\Exceptions\CartLimitExceededException;
use Roma\Task3\Exceptions\ItemOutOfStockException;


class Cart
{
  private array $items = [];
  private int $maxItem;

  public function __construct(int $maxItem = 20)
  {
    $this->maxItem = $maxItem;
  }

  public function addItem(Product &$product, int $quantity) : void
  {
    try {
      if (count($this->items) + $quantity > $this->maxItem) {
        throw new CartLimitExceededException('Корзина переполнена');
      }
      if ($product->getStock() < $quantity) {
        throw new ItemOutOfStockException('Нет такого кол-ва товара');
      }

      $product->reduceStock($quantity);
      for ($i = 0; $i < $quantity; $i++) {
        array_push($this->items, $product);
      }
    } catch (ItemOutOfStockException | CartLimitExceededException $e) {
      print $e->getMessage() . PHP_EOL;
    }
  }
  public function removeItem(Product $product) : void
  {
    $index = array_search($product->getName(), $this->items);
    unset($this->items, $index);
    array_values($this->items);
  }
  public function getTotal() : int
  {
    $totalCost = 0;
    for ($i = 0; $i < count($this->items); $i++) {
      $totalCost += $this->items[$i]->getPrice();
    }
    return $totalCost;
  }
}
