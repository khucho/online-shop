<?php
include_once __DIR__ . '/../model/Code.php';

class CodeController extends Code
{
    public function codes()
    {
        return $this->getCodes();
    }

    public function editVcCode($userId,$vcCode,$date)
    {
        return $this->updateVcCode($userId,$vcCode,$date);
    }
}

?>