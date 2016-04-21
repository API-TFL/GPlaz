<?php

require_once 'Google.php';

define('API_KEY', 'abcdefgh1230000000');

$google = new Google(API_KEY);
$google->setAddress('Bertrange, LU');
$results = $google->Geocode();

echo '<pre>';
print_r($results);

/* Searching places (Using location and store name)
$google = new Google(API_KEY);
$google->setQuery('Walmart, 33065, USA');
$results = $google->searchPlace();

echo '<pre>';
print_r($results);
#print_r($google->error);
*/
