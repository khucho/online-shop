<?php 
include_once __DIR__.'/../model/User.php';

class UserController extends User {

    public function getUser()
    {
        return $this->userLists();
    }

    public function deleteUser($id)
    {
        return $this->removeUser($id);
    }
}

?>