# Stock API Module
[![Build Status](https://travis-ci.org/fond-of/spryker-stock-api.svg?branch=master)](https://travis-ci.org/fond-of/spryker-stock-api)
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-spryker/stock-api)

The StockApi module provides a REST API for simple product stock updates.

## Installation

```
composer require spryker/stock-api
```

## API

Update stock of a concrete product.

##### PATCH /api/rest/stocks/{sku}

##### Example

```sh
curl -X PATCH "http://zed.yourdomain.com/api/rest/stocks/{sku}" \
     -H 'Content-Type: application/json' \
     -d $'{
          "data": {
            "quantity": 10,
            "stock_type": "Warehouse1",
            "is_never_out_of_stock": true            
          }
     }'
```
