<p align="center">
    <a href="https://en.wikipedia.org/wiki/Business_intelligence" target="_blank" rel="external">
        <img src="https://raw.githubusercontent.com/ziaadini/yii2-bi-dashboard/master/src/img/yii.png" height="80px">
    </a>
    <a href="" target="_blank" rel="external">
        <img src="https://raw.githubusercontent.com/ziaadini/yii2-open-banking/master/src/img/ob.png" height="80px">
    </a>
    <h1 align="center">Open banking extension for Yii 2</h1>
    <br>
</p>

# Yii2 Open Banking

**Openbanking** is an extension for integrating the service calls of various banking platforms, including Faraboom,
Finotech, Shaheen, and Shahkar.

This extension enables the unified management of calling various banking services for
the [Yii framework 2.0](http://www.yiiframework.com).

For license information check the [LICENSE](LICENSE.md)-file.

Installation
------------

### Using Composer (Preferred Method):

The preferred way to install this extension is through [composer](http://getcomposer.org/download/):

```
composer require --prefer-dist ziaadini/yii2-open-banking"*"
```

### Alternative Method:

If you prefer adding the openbanking extension to your `composer.json` file manually, you can do so by adding the
following entry to the `require` section:

```json
{
  "require": {
    "ziaadini/yii2-open-banking": "*"
  }
}
```

After adding the entry, save the `composer.json` file and run the following command in the terminal or command prompt
within your project directory:

```
composer update
```

This command will fetch and install the openbanking extension and its required dependencies into your Yii 2 project.

Configuration
-------------

To use this extension, you have to configure the openbanking module in your application configuration:

```php
return [
    //....
    'modules' => [
       'openbanking' => [
            'class' => 'sadi01\openbanking\Module'
        ],
    ]
];
```

and you have to configure the openbanking component in your application configuration:

```php
return [
    //....
    'components' => [
       'openBanking' => [
            'class' => 'sadi01\openbanking\components\OpenBanking',
            'bsVersion' => 4 //your project bs version
        ],
    ]
];
```

DB Migrations
-------------

Run module migrations:

```php
php yii migrate --migrationPath=@ziaadini/openbanking/migrations
```

Or, Add migrations path in console application config:

```php
'controllerMap' => [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationNamespaces' => [],
        'migrationPath' => [
            '@vendor/ziaadini/yii2-open-banking/src/migrations',
            '@app/migrations'
        ]
    ],
],
```

How To Use
-------------
add to your code:

```php
Yii::$app->openBanking->call('','',[])
```






Advanced config
-------------

- [Installation Guide](./src/guide/installation.md)

- [Faraboom Description Guide](./src/guide/faraboom.md)

- [Finnotech Description Guide](./src/guide/finnotech.md)