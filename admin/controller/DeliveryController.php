<?php

include_once __DIR__.'/../model/Delivery.php';


class DeliveryController extends Delivery 
{
    public function deliveryList()
    {
        return $this->getDeliveryList();
    }

    public function addDelivery($township,$fee)
    {
        return $this->createDelivery($township,$fee);
    }

    public function getDelivery($id)
    {
        return $this->getDeliveryById($id);
    }

    public function editDelivery($id,$township,$fee)
    {
        return $this->updateDelivery($id,$township,$fee);
    }

    public function deleteDelivery($id)
    {
        return $this->removeDelivery($id);
    }
}

?>