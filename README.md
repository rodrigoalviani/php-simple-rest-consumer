# php-simple-rest-consumer

##How to use
```php
<?php
require __DIR__ . '/api.class.php';

$api = new Api('http://api.address.com');

$get = $api::get('/myMethodGET');

$post = $api::post('/myMethodPOST', array('field' => 'value'));

$put = $api::put('/myMethodPUT', array('field' => 'value'));

$delete = $api::delete('/myMethodDELETE');
```
