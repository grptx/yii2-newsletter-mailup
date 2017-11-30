# yii2-newsletter-mailup
[![Latest Stable Version](https://poser.pugx.org/grptx/yii2-newsletter-mailup/v/stable)](https://packagist.org/packages/grptx/yii2-newsletter-mailup)
[![Total Downloads](https://poser.pugx.org/grptx/yii2-newsletter-mailup/downloads)](https://packagist.org/packages/grptx/yii2-newsletter-mailup)
[![Latest Unstable Version](https://poser.pugx.org/grptx/yii2-newsletter-mailup/v/unstable)](https://packagist.org/packages/grptx/yii2-newsletter-mailup)
[![License](https://poser.pugx.org/grptx/yii2-newsletter-mailup/license)](https://packagist.org/packages/grptx/yii2-newsletter-mailup)

Newsletter module to Yii2 - mailup integration

with this module you can collect email address and store in the [mailup](https://www.mailup.it/) newsletter service

## Installation
Preferred way to install is through [Composer](https://getcomposer.org): 
```shell
php composer.phar require grptx/yii2-newsletter-mailup:^1.0
```
Or, you may add

```php
"grptx/yii2-newsletter-mailup": "^1.0"
```

to the require section of your `composer.json` file and execute `php composer.phar update`.

### Configuration

```php
...
'modules' => [
    'newsletter' => [
        'class' => 'grptx\newsletter\mailup\Module',
        'client_id'=>'<your-client-id>',
        'client_secret'=>'<your-client-secret>',
        'callback_uri'=>'http://127.0.0.1/index.php',
        'username'=>'<your-username>',
        'password'=>'<your-password>',
        'group'=><your-recipents-group>,
    ],
...
]