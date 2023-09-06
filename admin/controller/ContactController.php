<?php
include_once __DIR__ . '/../model/Contact.php';
class ContactController extends Contact
{
    public function getMessage()
    {
        return $this->getMessages();
    }

    public function addMessage($name, $email, $phone, $message)
    {
        return $this->addMessages($name, $email, $phone, $message);
    }
}
