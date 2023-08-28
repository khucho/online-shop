<?php
include_once __DIR__ . '/../model/group.php';

class GroupController extends Group
{
    public function getGroup()
    {
        return $this->getGroupList();
    }
}

?>