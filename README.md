# Zfc Flash
ZF Adapters for different Flash Managers

There are many FLash Messages implementation and all of them have different interfaces.
This plugin provide one `FlashInterface` which allow write custom `Adapter` for any Flash library.

By default this package uses [`slim/flash`](https://github.com/slimphp/Slim-Flash).

Package has several registered namespace which allow group massages and show beauty html markup for all of them.
- default
- success
- warning
- error
- info

## Installation
```
composer require stagem/zfc-flash
```

**In Expressive**

You should enable module in `config/config.php` as `Stagem\ZfcFlash\ConfigProvider::class` 
and register middleware in`config/pipeline.php`
```php
$app->pipe(\Stagem\ZfcFlash\FlashMiddleware::class);
```
This allow gets flash object from request as `$flash = $request->getAttribute('flash');` 

## Usage
**In Expressive**
```php
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;

function($request, RequestHandlerInterface $handler)
{
    $flash = $request->getAttribute('flash');
    $flash->addMessage('Hello World!', 'success');

    return new RedirectResponse('/other-middleware');
}
```

Out of the box this module works with `Zend\View\Helper\FlashMessenger` and `twitter bootstrap`

Include `flash-messages` template in your template as `<?= $this->partial('widget::flash-messages') ?>`

If you want change html markup or style see section *Custom Flash*. 

## Custom Flash
Be carefully, you should enable your module after `Stagem\ZfcFlash\ConfigProvider::class` in `config/config.php` 


You can develop custom adapter for any `Flash Messages` only implement `Stagem\ZfcFlash\FlashInterface` 
and register in `depenencies` in your `config/module.config.php`

### Custom template
Create new *.phtml* file, get messages and implement custom html markup.
You can use [`current`](https://github.com/popovserhii/zfc-current) helper or other approach for get `Request` object 
and than get the `flash`. 

```php
// view/widget/flash-messages.phtml
#$flash = $this->current('request')->getAttribute('flash');
$messages = $flash->getAllMessages();
// iterate over array 
```

After that add your template to `config/module.config.php` and include in template
```php
return [
    'templates' => [
        'paths' => [
            'widget' => [__DIR__ . '/../view/widget'],
        ],
    ],
];
```