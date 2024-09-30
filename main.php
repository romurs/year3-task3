<?php

require_once 'vendor/autoload.php';

use Roma\Task3\Cart;
use Roma\Task3\Checkout;
use Roma\Task3\Product;

$keyboards = new Product('клавиатура', 5499, 52);
$mouses = new Product('мышка', 3499, 25);
$headphones = new Product('наушники', 4999, 44);

$cart = new Cart();

$checkout = new Checkout($cart, 'банковская карта', 74000);

$cart->addItem($keyboards, 2);
$cart->addItem($mouses, 18);

print $checkout->getUserBalance() .PHP_EOL;

$checkout->finalizeOrder();
print $checkout->getUserBalance();