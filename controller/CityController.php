<?php

include_once __DIR__.'/../model/City.php';


class CityController extends City 
{
    public function cityList()
    {
        return $this->getCityList();
    }
}

?>