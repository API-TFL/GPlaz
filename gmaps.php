<?php

class MapType
{
    const ROADMAP   = 'roadmap';
    const SATELLITE = 'satellite';
    const HYBRID    = 'hybrid';
    const TERRAIN   = 'terrain';
}

class MapPosition
{
    const ABSOLUTE = 'absolute';
}

class MapZoom
{
    const WORLD     = 1;
    const LANDMASS  = 5;
    const CONTINENT = 5;
    const CITY      = 10;
    const STREETS   = 15;
    const BUILDINGS = 18;
}

class Map
{
    private $key;
    private $id;
    private $map_type;
    private $auto_zoom;
    private $zoom_level = 0;
    private $lat        = 0;
    private $lng        = 0;
    private $map_postion;
    private $html_attr;
    private $html_value;
    private $info_window;
    private $markers;
    private $render_without_script = FALSE;

    public function __construct($key)
    {
        $this->key = (string) $key;
    }

    public function setId($id)
    {
        if (ctype_alpha($id{0}))
        {
            $this->id = $id;
        }
        else
        {
            $this->id = '_'.preg_replace("/[^a-zA-Z0-9_]+/", "", $id);
        }

    }

    public function setAutoZoom($auto_zoom = TRUE)
    {
        $this->auto_zoom = (bool) $auto_zoom;
    }

    public function setZoomLevel($zoom_level)
    {
        if ((int) $zoom_level < 0)
        {
            $this->zoom_level = (int) 0;
        }
        elseif ((int) $zoom_level > 18)
        {
            $this->zoom_level = (int) 18;
        }
        else
        {
            $this->zoom_level = (int) $zoom_level;
        }
    }

    public function setCenter($lat, $lng)
    {
        $this->lat = (int) $lat;
        $this->lng = (int) $lng;
    }

    public function setMapType($type)
    {
        $this->map_type = $type;
    }

    public function setStylePostion($position)
    {
        $this->map_postion = $position;
    }

    // $map->setHtmlAttribute('class', 'my-class');
    public function setHtmlAttribute($attribute, $value)
    {
        $this->html_attr  = $attribute;
        $this->html_value = $value;
    }

    public function infoWindow(array $windows)
    {
        $this->info_window = $windows;
    }

    public function setMarkers(array $markers)
    {
        $this->markers = $markers;
    }

    public function renderWithoutScript($render_without_script = TRUE)
    {
        $this->render_without_script = (bool) $render_without_script;
    }

    public function renderScript()
    {
        return '<script src="https://maps.googleapis.com/maps/api/js?key='.$this->key.'&callback='.$this->id.'"></script>';
    }

    public function render()
    {
        if (empty($this->id) || is_numeric($this->id))
        {
            $this->id = '_map';
        }

        $html  = '<div id="'.$this->id.'" style="width:100%;height:500px"></div>';
        $html .= '<script>function '.$this->id.'() {';
        $html .= 'var mapCanvas = document.getElementById("'.$this->id.'");';
        $html .= 'var mapOptions = {';
        $html .= 'center: new google.maps.LatLng('.$this->lat.', '.$this->lng.')';

        if ($this->auto_zoom === FALSE)
        {
            $html .= ',zoom:'.$this->zoom_level;
        }

        if (!empty($this->map_type))
        {
            $html .= ',mapTypeId:\''.$this->map_type.'\'';
        }

        $html .= '}; var map = new google.maps.Map(mapCanvas, mapOptions);';

        if (!empty($this->info_window))
        {
            // make a foreach here of info_window
            $html .= 'var infowindow = new google.maps.InfoWindow({
              content: \'some cool text here<br/><strong>BAM!</strong>\'
            });';
        }

        if (!empty($this->markers))
        {
            $html .= 'var marker = [];';

            foreach ($this->markers as $key => $value)
            {
                $html .= 'marker['.((int) $key).'] = new google.maps.Marker({
                position: {lat: '.$value['lat'].', lng: '.$value['lng'].'},
                map: map,
                title: \''.$value['title'].'\'
                });';
            }
        }

        if (!empty($this->info_window))
        {
            $html .= ' marker.addListener(\'click\', function() {
            infowindow.open(map, marker);});';
        }

        $html .= '} </script>';


        if ($this->render_without_script === FALSE)
        {
            $html .= '<script src="https://maps.googleapis.com/maps/api/js?key='.$this->key.'&callback='.$this->id.'"></script>';
        }

        return (string) $html;
    }
}
