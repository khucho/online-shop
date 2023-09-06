<?php
include_once __DIR__ . '/../model/contact.php';
class ContactController extends Contact
{
    public function addMessage($name, $email, $phone, $message)
    {
        return $this->addMessages($name, $email, $phone, $message);
    }
}
