<?php

include_once __DIR__.'/../model/City.php';


class CityController extends City 
{
    public function cityList()
    {
        return $this->getCityList();
    }

    public function addCity($name)
    {
        return $this->createCity($name);
    }

    public function getCity($id)
    {
        return $this->getCityById($id);
    }

    public function editCity($id,$name)
    {
        return $this->updateCity($id,$name);
    }

    public function deleteCity($id)
    {
        return $this->removeCity($id);
    }
}

?>