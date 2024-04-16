<?php

namespace Omnipay\Iyzico\Message;

use Iyzipay\Model\Address;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\Payment;
use Iyzipay\Model\PaymentCard;
use Iyzipay\Model\ThreedsPayment;
use Iyzipay\Request\CreatePaymentRequest;
use Omnipay\Common\CreditCard;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Iyzico\Customer;

/**
 * Iyzico Purchase Request
 *
 * (c) Yasin Kuyu
 * 2015, insya.com
 * http://www.github.com/yasinkuyu/omnipay-iyzico
 */
class PurchaseRequest extends AbstractRequest
{

    protected $actionType = 'purchase';

    protected $endpoints = [
        'test' => 'https://sandbox-api.iyzipay.com',
        'live' => 'https://api.iyzipay.com'
    ];

    public function getData()
    {
        $request = $this->getRequestObject();
        $request->setPaymentCard($this->getPaymentCard());
        $request->setBuyer($this->getBuyer());
        $request->setBillingAddress($this->getBillingAddress());

        (null !== $this->getBasketId()) ? $request->setBasketId($this->getBasketId()) : null; // BasketId is optional
        (null !== $this->getPaymentChannel()) ? $request->setPaymentChannel($this->getPaymentChannel()) : null; // PaymentChannel is optional
        (null !== $this->getPaymentGroup()) ? $request->setPaymentGroup($this->getPaymentGroup()) : null; // PaymentGroup is optional
        (!empty($this->getReturnUrl())) ? $request->setCallbackUrl($this->getReturnUrl()) : null;

        $request->setBasketItems($this->getBasketItems());

        return $request;
    }

    private function getRequestObject()
    {
        $request = new \Iyzipay\Request\CreatePaymentRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setConversationId($this->getConversationId());
        $request->setPrice($this->getAmount()); // or getAmountInteger
        $request->setPaidPrice($this->getAmount());
        $request->setCurrency(\Iyzipay\Model\Currency::TL);
        $request->setInstallment(1);
        $request->setBasketId("B67832");
        $request->setPaymentChannel(\Iyzipay\Model\PaymentChannel::WEB);
        $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);

        return $request;
    }

    private function getPaymentCard() {
        $paymentCard = new \Iyzipay\Model\PaymentCard();
        $paymentCard->setCardHolderName($this->getCard()->getName());
        $paymentCard->setCardNumber($this->getCard()->getNumber());
        $paymentCard->setExpireMonth($this->getCard()->getExpiryMonth());
        $paymentCard->setExpireYear($this->getCard()->getExpiryYear());
        $paymentCard->setCvc($this->getCard()->getCvv());
        $paymentCard->setRegisterCard(0);

        return $paymentCard;
    }

    private function getBuyer() {
        $card = $this->getCard();

        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId($this->getConversationId());
        $buyer->setName($card->getFirstName());
        $buyer->setSurname($card->getLastName());
        $buyer->setGsmNumber($card->getPhone());
        $buyer->setEmail($card->getEmail());
        $buyer->setIdentityNumber($this->getIdentityNumber());
        $buyer->setLastLoginDate(date('Y-m-d H:i:s'));
        $buyer->setRegistrationDate(date('Y-m-d H:i:s'));
        $buyer->setRegistrationAddress($card->getAddress1());
        $buyer->setIp($this->getClientIp());
        $buyer->setCity($card->getCity());
        $buyer->setCountry($card->getCountry());
        $buyer->setZipCode($card->getPostcode());

        return $buyer;
    }

    private function getBillingAddress() {
        $card = $this->getCard();

        $billingAddress = new \Iyzipay\Model\Address();
        $billingAddress->setContactName($card->getBillingFirstName() . " " . $card->getBillingLastName());
        $billingAddress->setCity($card->getBillingCity());
        $billingAddress->setCountry($card->getBillingCountry());
        $billingAddress->setAddress($card->getBillingAddress1());
        $billingAddress->setZipCode($card->getBillingPostcode());

        return $billingAddress;
    }

    /**
     * @return array
     */
    private function getBasketItems()
    {
        $items = $this->getItems();

        if (!empty($items)) {
            foreach ($items as $key => $item) {
                $firstBasketItem = new \Iyzipay\Model\BasketItem();
                $firstBasketItem->setId($item->getName());
                $firstBasketItem->setName($item->getName());
                $firstBasketItem->setCategory1("Genel");
                $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
                $firstBasketItem->setPrice($item->getPrice());

                $basketItems[] = $firstBasketItem;

            }
        }

        return $basketItems;
    }

    public function getOptions()
    {
        $mode = $this->getTestMode() ? "test" : "live";

        $options = new \Iyzipay\Options();
        $options->setApiKey($this->getApiId());
        $options->setSecretKey($this->getSecretKey());
        $options->setBaseUrl($this->endpoints[$mode]);

        return $options;
    }

    public function sendData($data)
    {
        $response = \Iyzipay\Model\Payment::create($data, $this->getOptions());

        return [
            'isSuccessful' => $response->getStatus() == 'success' ? true : false,
            'error' =>  [
                'code' => $response->getErrorCode(),
                'message' => $response->getErrorMessage()
            ]
        ];
    }


    public function getRegisterCard() {
        return $this->getParameter('registerCard');
    }

    public function setPaymentChannel($value) {
        $this->setParameter('paymentChannel', $value);
    }

    public function getPaymentChannel() {
        return $this->getParameter('paymentChannel');
    }

    public function setPaymentGroup($value) {
        $this->setParameter('paymentGroup', $value);
    }

    public function getPaymentGroup() {
        return $this->getParameter('paymentGroup');
    }

    public function setBasketId($value) {
        $this->setParameter('basketId', $value);
    }

    public function getBasketId() {
        return $this->getParameter('basketId');
    }

    public function getConversationId()
    {
        return $this->getParameter('conversationId');
    }

    public function setConversationId($value)
    {
        return $this->setParameter('conversationId', $value);
    }

    public function getPaymentId()
    {
        return $this->getParameter('paymentId');
    }

    public function setPaymentId($value)
    {
        return $this->setParameter('paymentId', $value);
    }

    public function getPaymentTransactionId()
    {
        return $this->getParameter('paymentTransactionId');
    }

    public function setPaymentTransactionId($value)
    {
        return $this->setParameter('paymentTransactionId', $value);
    }

    public function getIdentityNumber()
    {
        return $this->getParameter('identityNumber');
    }

    public function setIdentityNumber($value)
    {
        return $this->setParameter('identityNumber', $value);
    }

    public function getSecure3d()
    {
        return $this->getParameter('secure3d');
    }

    public function setSecure3d($value)
    {
        return $this->setParameter('secure3d', $value);
    }

    public function getBank()
    {
        return $this->getParameter('bank');
    }

    public function setBank($value)
    {
        return $this->setParameter('bank', $value);
    }

    public function getApiId()
    {
        return $this->getParameter('apiId');
    }

    public function setApiId($value)
    {
        return $this->setParameter('apiId', $value);
    }

    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    public function getInstallment()
    {
        return $this->getParameter('installment');
    }

    public function setInstallment($value)
    {
        return $this->setParameter('installment', $value);
    }

    public function getEnabledInstallments()
    {
        return $this->getParameter('enabled_installments');
    }

    public function setEnabledInstallments($value)
    {
        return $this->setParameter('enabled_installments', $value);
    }

    public function getType()
    {
        return $this->getParameter('type');
    }

    public function setType($value)
    {
        return $this->setParameter('type', $value);
    }

}
