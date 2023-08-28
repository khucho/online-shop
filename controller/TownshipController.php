<?php

include_once __DIR__.'/../model/Township.php';


class TownshipController extends Township 
{
    public function townshipList()
    {
        return $this->getTownshipList();
    }
}

?>