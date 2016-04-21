<?php

require_once 'Google.php';
require_once 'apikey.php';

$google = new Google(API_KEY);
$google->setAddress('Bertrange, Luxembourg');

if ($results = $google->Geocode())
{
    $google_maps = array
    (
        'address' => 'Bertrange, Luxembourg',
        'lat' => $results[0]->geometry->location->lat,
        'lng' => $results[0]->geometry->location->lng
    );

    var_dump(serialize($google_maps));
}

/* Searching places (Using location and store name)
$google = new Google(API_KEY);
$google->setQuery('Walmart, 33065, USA');
$results = $google->searchPlace();

echo '<pre>';
print_r($results);
#print_r($google->error);
*/
