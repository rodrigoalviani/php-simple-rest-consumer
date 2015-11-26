# php-simple-rest-consumer

##How to use
```php
<?php
require __DIR__ . '/api.class.php';

$api = new Api('http://api.address.com');

// use GET verb
$get = $api::get('/myMethodGET');

// use POST verb
$post = $api::post('/myMethodPOST', array('field' => 'value'));

// use PUT verb
$put = $api::put('/myMethodPUT', array('field' => 'value'));

// use DELETE verb
$delete = $api::delete('/myMethodDELETE');

// use DELETE verb with header auth
$delete = $api::delete('/myMethodDELETE', 'Authorization: Bearer XXXXXXXXXXXXXXX');
```

Send custom header is available
