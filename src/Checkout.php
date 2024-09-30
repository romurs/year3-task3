<?php

namespace Roma\Task3;

use Roma\Task3\Cart;
use Roma\Task3\Exceptions\InsufficientFundsException;
use Roma\Task3\Exceptions\PaymentGatewayException;

class Checkout
{
  private Cart $cart;
  private string $paymentMethod;
  private int $userBalance;

  public function __construct(Cart $cart, string $paymentMethod, int $userBalance)
  {
    $this->cart = $cart;
    $this->paymentMethod = $paymentMethod;
    $this->userBalance = $userBalance;
  }

  public function setPaymentMethod(string $method)
  {
    $this->paymentMethod = $method;
  }
  public function processPayment($amount)
  {
    try {
      if ($this->userBalance < $amount) {
        throw new InsufficientFundsException('Недостаточно бабок');
      }
      if ($this->paymentMethod != 'банковская карта') {
        throw new PaymentGatewayException('Ошибка при оплате');
      }

      $this->userBalance -= $amount;
    } catch (InsufficientFundsException | PaymentGatewayException  $e) {
      print $e->getMessage();
    }
  }
  public function finalizeOrder()
  {
    $totalAmount = $this->cart->getTotal();
    try {
      $this->processPayment($totalAmount);
    } catch (InsufficientFundsException | PaymentGatewayException $e) {
      print "Ошибка при оплате: " . $e->getMessage();
    }
  }

  public function getUserBalance()
  {
    return $this->userBalance;
  }
}
