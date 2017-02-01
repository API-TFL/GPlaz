<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'gmaps.php';

define('KEY', 'xxxxx');

$map = new Map(KEY);
$map->setId('12_3');
$map->setAutoZoom(FALSE);
$map->setZoomLevel(MapZoom::CITY);
$map->setCenter(49.57552935827966, 6.090646688697541);
$map->setMapType(MapType::ROADMAP);
$map->renderWithoutScript();

// https://developers.google.com/maps/documentation/javascript/markers
// https://developers.google.com/maps/documentation/javascript/maptypes

$map->infoWindow(array
(
    0 => 'Window 1',
    1 => 'Window 2'
));

echo $map->render();
echo $map->renderScript();
