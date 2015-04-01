# php-simple-rest-consumer

##How to use
```php
<?php
require __DIR__ . '/api.class.php';

$api = new Api('http://api.address.com');

$get = $api::get('/myMethodGET');

$post = $api::post('/myMethodPOST', array('field' => 'value'));

$post = $api::put('/myMethodPUT', array('field' => 'value'));

$post = $api::delete('/myMethodDELETE');
```
