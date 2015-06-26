<?php

namespace Festitime\bundles\UserBundle\Services\Paypal;

use Festitime\DatabaseBundle\Document\Ticket;
use Festitime\DatabaseBundle\Document\Hotel;
use Festitime\DatabaseBundle\Document\Order;
use PayPal\Api\Amount;
use PayPal\Rest\ApiContext;
use PayPal\Api\Details;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;

class PaypalProvider
{
    protected $mongoManager;

    protected $apiContext;

    protected $tax = 0;

    protected $shipping = 0;

    protected $currency = 'EUR';

    protected $itemList;

    protected $total = 0;

    public function __construct(
        $doctrineMongodb,
        $clientId,
        $clientSecret,
        $paypalMode,
        $paypalLogLevel,
        $rootDirPath
    ) {
        $this->mongoManager = $doctrineMongodb->getManager();
        $this->apiContext = new ApiContext(new OAuthTokenCredential($clientId, $clientSecret));
        $this->apiContext->setConfig(array(
            'mode' => $paypalMode,
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => $rootDirPath.'/logs/paypal.log',
            'log.LogLevel' => $paypalLogLevel
        ));
    }

    public function getApiContext()
    {
        return $this->apiContext;
    }

    public function getNewPayer()
    {
        $payer = new Payer();
        return $payer->setPaymentMethod('paypal');
    }

    public function findTicket($id)
    {
        return $this->mongoManager->find('FestitimeDatabaseBundle:Ticket', $id);
    }

    public function findHotel($id)
    {
        return $this->mongoManager->find('FestitimeDatabaseBundle:Hotel', $id);
    }

    public function addItemToList(Item $item)
    {
        if (empty($this->itemList)) {
            $this->itemList = new ItemList();
        }

        $this->total += $item->getPrice() * $item->getQuantity();
        $this->itemList->addItem($item);
    }

    public function getItem($name, $quantity, $price, $sku)
    {
        $item = new Item();
        return $item->setName($name) // item name
            ->setCurrency($this->currency)
            ->setQuantity($quantity)
            ->setPrice($price) // unit price
            ->setTax(strval($price * $this->tax))
            ->setSKU($sku);
    }

    public function getItemFromTicket(Ticket $ticket, $quantity)
    {
        return $this->getItem($ticket->getName(), $quantity, $ticket->getPrice(), $ticket->getId());
    }

    public function getItemFromTravelData($name, $quantity, $price)
    {
        return $this->getItem($name, $quantity, $price, uniqid());
    }

    public function getItemFromHotel(Hotel $hotel, $quantity)
    {
        return $this->getItem($hotel->getName(), $quantity, $hotel->getPrice(), $hotel->getId());
    }

    public function getTransaction()
    {
        $details = new Details();
        $details->setSubtotal($this->total)
                ->setTax($this->total * $this->tax)
                ->setShipping($this->shipping);

        $amount = new Amount();
        $amount->setCurrency($this->currency)
            ->setTotal($this->total + $this->total * $this->tax + $this->shipping)
            ->setDetails($details);

        $transaction = new Transaction();
        return $transaction->setAmount($amount)
            ->setItemList($this->itemList)
            ->setDescription('Le package que vous avez choisi sur festitime.com');
    }

    public function getPayment($payer, $redirectUrls, $transaction)
    {
        $payment = new Payment();
        return $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
    }

    public function saveOrder($paypalPaymentId)
    {
        $order = new Order();
        $order->setPaypalPaymentId($paypalPaymentId);
        $order->setPrice($this->total);
        $order->setState("waiting");
        $this->mongoManager->persist($order);
        $this->mongoManager->flush();
    }

    public function validateOrder($paymentId)
    {
        $orderRepository = $this->mongoManager->getRepository('FestitimeDatabaseBundle:Order');
        $order = $orderRepository->findOneBy(array('paypalPaymentId' => $paymentId));
        $order->setState("validate");
        $this->mongoManager->persist($order);
        $this->mongoManager->flush();
    }
}
