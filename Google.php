<?php

require_once 'setters.php';
require_once 'gmaps.php';

final class Google extends setters
{
    public function Geocode()
    {
        $this->url = 'https://maps.googleapis.com/maps/api/geocode/json?';

        switch (TRUE)
        {
            case (!empty($this->lat) && !empty($this->lng)):

                $this->url .= 'latlng='.$this->lat.','.$this->lng;
                break;

            case (!empty($this->address)):

                $this->url .= 'address='.$this->address;
                break;
        }

        $this->url .= '&sensor='.$this->sensor
                     .'&key='.$this->apiKey;

        return $this->getData();
    }
    
    public function Geolocation()
    {
        $this->url = 'https://www.googleapis.com/geolocation/v1/geolocate?'
                    .'query='.$this->query
                    .'&key='.$this->apiKey;

        return $this->getData();
    }

    public function searchPlace()
    {
        $this->url = 'https://maps.googleapis.com/maps/api/place/textsearch/json?'
                    .'query='.$this->query
                    .'&sensor='.$this->sensor
                    .'&radius='.$this->radius
                    .'&key='.$this->apiKey;

        return $this->getData();
    }

    public static function Maps($key)
    {
        return new Map($key);
    }
}
