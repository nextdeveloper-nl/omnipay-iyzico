<?php

namespace Omnipay\Iyzico;

use Illuminate\Support\Facades\App;
use Omnipay\Common\AbstractGateway;

/**
 * Iyzico Gateway
 *
 * (c) Yasin Kuyu
 * 2015, insya.com
 * http://www.github.com/yasinkuyu/omnipay-iyzico
 *
 * This file is altered by Harun Barış Bulut (baris.bulut@plusclouds.com)
 */
class Gateway extends AbstractGateway {

    public function getName() {
        return 'Iyzico';
    }

    public function getDefaultParameters() {
        return array(
            'apiId'     => null,
            'secretKey'  => null,
            'testMode'   => true,
            'amount'    =>  0,
            'secure3d'  =>  false,
            'currencyCode'  =>  'USD'
        );
    }

    /**
     * @param string $value
     *
     * @return Gateway
     */
    public function setApiKey($value) {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * @return string
     */
    public function getApiKey() {
        return $this->getParameter('apiKey');
    }

    /**
     * @param string $value
     *
     * @return Gateway
     */
    public function setSecretKey($value) {
        return $this->setParameter('secretKey', $value);
    }

    /**
     * @return mixed
     */
    public function getSecretKey() {
        return $this->getParameter('secretKey');
    }

    /**
     * @param bool $value
     *
     * @return AbstractGateway|Gateway
     */
    public function setTestMode($value) {
        return $this->setParameter('testMode', (bool)$value);
    }

//    public function authorize(array $parameters = array()) {
//        return $this->createRequest('\Omnipay\Iyzico\Message\AuthorizeRequest', $parameters);
//    }
//
//    public function capture(array $parameters = array()) {
//        return $this->createRequest('\Omnipay\Iyzico\Message\CaptureRequest', $parameters);
//    }
//
    public function purchase(array $parameters = array()) {
        return $this->createRequest('\Omnipay\Iyzico\Message\PurchaseRequest', $parameters);
    }

    public function set3dSecure($value) {
        return $this->setParameter('secure3d', (bool)$value);
    }

    public function get3dSecure() {
        return $this->getParameter('secure3d');
    }

    public function setLocale($value) {
        return $this->setParameter('locale', $value);
    }

    public function getLocale() {
        return $this->getParameter('locale');
    }

//
//    public function checkout(array $parameters = array()) {
//        return $this->createRequest('\Omnipay\Iyzico\Message\CheckoutRequest', $parameters);
//    }
//
//    public function checkoutStatus(array $parameters = array()) {
//        return $this->createRequest('\Omnipay\Iyzico\Message\CheckoutStatusRequest', $parameters);
//    }
//
//    public function refund(array $parameters = array()) {
//        return $this->createRequest('\Omnipay\Iyzico\Message\RefundRequest', $parameters);
//    }
//
//    public function void(array $parameters = array()) {
//        return $this->createRequest('\Omnipay\Iyzico\Message\VoidRequest', $parameters);
//    }
//
    public function getApiId() {
        return $this->getParameter('apiId');
    }

    public function setApiId($value) {
        return $this->setParameter('apiId', $value);
    }
//
//    public function getToken() {
//        return $this->getParameter('token');
//    }
//
//    public function setToken($value) {
//        return $this->setParameter('token', $value);
//    }
//
//    public function getIdentityNumber() {
//        return $this->getParameter('identityNumber');
//    }
//
//    public function setIdentityNumber($value) {
//        return $this->setParameter('identityNumber', $value);
//    }
//
    public function getInstallment() {
        return $this->getParameter('installment');
    }

    public function setInstallment($value) {
        return $this->setParameter('installment', $value);
    }
//
//    public function getEnabledInstallments() {
//        return $this->getParameter('enabled_installments');
//    }
//
//    public function setEnabledInstallments($value) {
//        return $this->setParameter('enabled_installments', $value);
//    }
//
//    public function getType() {
//        return $this->getParameter('type');
//    }
//
//    public function setType($value) {
//        return $this->setParameter('type', $value);
//    }
//
    public function getOrderId() {
        return $this->getParameter('orderid');
    }

    public function setOrderId($value) {
        return $this->setParameter('orderid', $value);
    }
//
//    public function getTransId() {
//        return $this->getParameter('transId');
//    }
//
//    public function setTransId($value) {
//        return $this->setParameter('transId', $value);
//    }

}
