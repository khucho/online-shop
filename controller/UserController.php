<?php
include_once __DIR__.'/../model/User.php';


class UserController extends User
{
    public function addUserDetail($info)
    {
        return $this->createUserDetail($info);

        if (isset($info['name']))
        {
            $this->changeName($info['name']);
        }
    }
}
?>