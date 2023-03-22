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
 
The defaults configuration settings are set in `config/sap.php` as shown below and you can modify the values.

``` php
'sap' => [
        "https"         => false,
        "host"          => "IP/HOST Address eg 192.168.1.1",
        "port"          => 50000,
        "sslOptions"    => ["cafile" => "path/to/certificate.crt","verify_peer" => true,"verify_peer_name" => true,],
        "version"       => 1
    ],
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
    $sap = SAPClient::createSession('SAP UserName', 'SAP Password', 'Company DB');
```

Grab the SAP Business One session.

```php
    $session = $sap->getSession();
```

Example of pulling orders using session saved above:

```php
    $sap = new SAPClient(config('sap.sap') ,$session);
    $orders = $sap->getService('Orders');
    $result = $orders->queryBuilder()
    ->select('DocEntry,DocNum')
    ->orderBy('DocNum', 'asc')
    ->limit(5)
    ->findAll();
```
### License of SAPBOSL

This SAPBOSL is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
