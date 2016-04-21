<?php

abstract class request
{
    public $error = array();
    protected $apiKey;

    public function __construct($apiKey)
    {
        if (strlen($apiKey) > 38)
        {
            $this->apiKey = $apiKey;
        }
        else
        {
            $this->error[] = 'less than 38 character key length';
        }
    }

    protected function getData()
    {
        if (!empty($this->url))
        {
            if ($string = file_get_contents($this->url))
            {
                $results = json_decode($string);

                if (isset($results->results))
                {
                    return $results->results;
                }
                elseif (isset($results))
                {
                    return $results;
                }
                else
                {
                    return FALSE;
                }
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    public function showURL()
    {
        return $this->url;
    }
}
