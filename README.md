Yii2 Url Language management
============================
Language mangement for URL's

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist cyberz/yii2-language-url "*"
```

or add

```
"cyberz/yii2-language-url": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

1)Apply migartion:
```php
php yii migrate/up --migrationPath=vendor/cyberz/yii2-language-url/language/migrations
```

2)Setup config:
```php 
'components' => [
    'request' => [
        'class' => 'cyberz\language\components\LanguageRequest'
            ...
     'urlManager' => [
                'class'=>'cyberz\language\components\LanguageUrlManager',
            ...
```

3)Use widget:            
```php
<?= \cyberz\language\widgets\Switcher::widget(); ?>
```