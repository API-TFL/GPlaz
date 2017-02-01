<?php

require_once 'request.php';

class setters extends request
{
    protected $query;
    protected $address;
    protected $lat;
    protected $lng;
    protected $url;
    protected $sensor = 'true';
    protected $radius = 20;

    public function setSensor($sensor)
    {
        if ($sensor === TRUE || $sensor == 'true')
        {
            $this->sensor = 'true';
        }
        if ($sensor === FALSE || $sensor == 'false')
        {
            $this->sensor = 'false';
        }
    }

    public function setQuery($query)
    {
        $this->query = urlencode($query);
    }

    public function setRadius($radius)
    {
        if ((int) $radius > 0)
        {
            $this->radius = $radius;
        }
    }

    public function setAddress($address)
    {
        $this->address = urlencode(utf8_encode($address));
    }

    public function setLatLng($lat, $lng)
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    public function setLng($lng)
    {
        $this->lng = $lng;
    }
}
