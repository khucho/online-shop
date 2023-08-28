<?php

include_once __DIR__.'/../model/Township.php';


class TownshipController extends Township 
{
    public function townshipList()
    {
        return $this->getTownshipList();
    }

    public function addTownship($township,$city)
    {
        return $this->createTownship($township,$city);
    }

    public function getTownship($id)
    {
        return $this->getTownshipById($id);
    }

    public function editTownship($id,$township,$city)
    {
        return $this->updateTownship($id,$township,$city);
    }

    public function deleteTownship($id)
    {
        return $this->removeTownship($id);
    }
}

?>