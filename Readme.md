## SAPBOSL Wrapper for Laravel


### Install SAPBOSL

    composer require realsoftgt/sap-b1-sl

### Configurate SAPBOSL

Add the following line to your Config/app.php  Providers:
```php
    RealSoft\SAPBOSL\SAPBOSLServiceProvider::class
```

Add the following line to your Config/app.php Aliases:
```php
    'SAPClient' => RealSoft\SAPBOSL\SAPClient::class,
```

You can publish the config using this command:
```shell
    php artisan vendor:publish --provider="RealSoft\SAPBOSL\SAPBOSLServiceProvider"
```
 
The defaults configuration settings are set in `config/SAP.php` as shown below and you can modify the values.

``` php

    'https'         => env('SAP_SECURE_URL', false),
    'host'          => env('SAP_BASE_URL', '192.168.1.1'),
    'port'          => env('SAP_BASE_PORT', 50000),
    'company_db'    => env('SAP_COMPANY_DB'),
    'username'      => env('SAP_USERNAME'),
    'password'      => env('SAP_PASSWORD'),
    'sslOptions'    => [
            'cafile'            => env('SAP_BASE_SSL_CA_PATH', 'path/to/certificate.crt'),
            'verify_peer'       => env('SAP_BASE_SSL_VERIFY_PEER', true),
            'verify_peer_name'  => env('SAP_BASE_SSL_VERIFY_PEER_NAME', true),
        ],
    'version'       => env('SAP_BASE_VERSION', 2)
```
As we can see, these settings can come from the .env environment variables file with the following variables:
```shell
#...
SAP_SECURE_URL=false
SAP_BASE_URL=192.168.1.1
SAP_BASE_PORT=50000
SAP_COMPANY_DB='MY_COMPANY_DB'
SAP_USERNAME='Demo01'
SAP_PASSWORD='Demo01#'
SAP_BASE_SSL_CA_PATH='path/to/certificate.crt'
SAP_BASE_SSL_VERIFY_PEER=true
SAP_BASE_SSL_VERIFY_PEER_NAME=true
SAP_BASE_VERSION=2
#...
```

You update config using this command:
```shell
    php artisan config:cache
```

## Using SAPBOSL

Use SAPClient in your controller.
```php
    use RealSoft\SAPBOSL\SAPClient;
```

Create a new Service Layer session.

```php
    $sap = SAPClient::createSession(config('username'), config('password'), config('company_db'));
```

Grab the SAP Business One session.

```php
    $session = $sap->getSession();
```

Example of pulling orders using session saved above:

```php
    $sap = new SAPClient(config('SAP') ,$session);
    $orders = $sap->getService('Orders');
    $result = $orders->queryBuilder()
    ->select('DocEntry,DocNum')
    ->orderBy('DocNum', 'asc')
    ->limit(5)
    ->findAll();
```
### License of SAPBOSL

This SAPBOSL is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
