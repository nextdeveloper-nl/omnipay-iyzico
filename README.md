# Omnipay: Iyzico

This library is a fork of; "yasinkuyu/omnipay-iyzico" library. We will be implementing full feature Omnipay library over the top of this library.

## Features implemented
- [x] Purchase

**Iyzico gateway for Omnipay payment processing library**

[![License](https://poser.pugx.org/nextdeveloper/omnipay-iyzico/license)](https://packagist.org/packages/nextdeveloper/omnipay-iyzico)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Iyzico (Turkish Payment Gateways) support for Omnipay.

# Readme TR
Iyzico v3 (3D Secure) sanal pos hizmeti için omnipay kütüphanesi.

Test ortamım için https://sandbox-merchant.iyzipay.com/auth adresinden kayıt olup hemen sonrasında(mail onaysız) login olabilirsiniz. 

Login olduktan sonra karşınıza çıkan “Cep Telefonu Doğrulama” ekranına sms kodu olarak “123456" yazıp giriş sağlayabilirsiniz. Ayarlar sayfasından api anahtarları bölümünden API anahtarı ve güvenlik anahtarı bilgilerine erişebiliyorsunuz. 

Sandbox/test base url https://sandbox-api.iyzipay.com/ set edildiğinde githubdaki clientlarımız
Test kartları https://dev.iyzipay.com/tr/test-kartlari

Ay ve yıl olarak herhangi bir ileri değer verebilirsiniz. Cvv içinde aynı şekilde 3 haneli random bir değer verebilirsiniz. 3D secure şifresi : 283126

## Installation

    composer require league/omnipay iyzico/iyzipay-php nextdeveloper/omnipay-iyzico

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "iyzico/iyzipay-php": "^2.0",
        "nextdeveloper/omnipay-iyzico": "*"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package: **Not yet revisited**

* Iyzico v3

Gateway Methods

* purchase($options) - authorize and immediately capture an amount on the customer's card
* refund($options) - refund an already processed transaction

* checkout($options) - iyzico host payment method
* checkout_status($options) - iyzico host payment method status

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Unit Tests

PHPUnit is a programmer-oriented testing framework for PHP. It is an instance of the xUnit architecture for unit testing frameworks.

## Requirements
    composer require iyzico/iyzipay-php

    To use the bindings, use Composer's autoload:

    require_once('vendor/autoload.php');


Composer dependencies require a PHP version ">= 8.1.0"

## Sample App
        
    purchase.php
    refund.php
    void.php

    checkout.php (iyzico host)

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project, or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/yasinkuyu/omnipay-iyzico/issues),
or better yet, fork the library and submit a pull request.
