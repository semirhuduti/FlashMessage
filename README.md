[![Build Status](https://travis-ci.org/semirhuduti/FlashMessage.svg?branch=master)](https://travis-ci.org/semirhuduti/FlashMessage)[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/semirhuduti/FlashMessage/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/semirhuduti/FlashMessage/?branch=master)

# FlashMessage

This module is used to display flash messages in your project.

To use this module the following code needs be added in the frotcontroller.

```php
$di->setShared('flash', function() {
    $flash = new \Anax\FlashMessage\FlashMessage();
    return $flash;
});
```
If you want to keep the code consistent it also can be added in the CDIFactoryDefault that is located in src/DI. It should be added like this. 
```php
$this->setShared('flash', function() {
    $flash = new \Anax\FlashMessage\FlashMessage();
    return $flash;
});
```

To use the the flash messages add the following line to your project.
```php
  $app->flash->message('information', 'This is a info message');
  $app->flash->message('warning', 'This is a warning message');
  $app->flash->message('success', 'This is a success message');
  $app->flash->message('error', 'This is a error message');
```

This will generate HTML-code that will be displayed in the view.

The style of the flash messages can be changed in the flash.css file.
