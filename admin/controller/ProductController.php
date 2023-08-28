<?php
include_once __DIR__.'/../model/Product.php';

class ProductController extends Product
{
    public function getProducts()
    {
        return $this->getProductInfo();
    }
    public function addProduct($name,$description,$price,$date,$image,$category,$group)
    {
        if ($image['error'] == 0)
        {
            $fileName = $image['name'];
            $tempFile = $image['tmp_name'];

            $timeStamp = time();
            $fileName = $timeStamp.$fileName;
           if ( move_uploaded_file($tempFile,'../../../uploads/'.$fileName))
           {
            return $this->createProduct($name,$description,$price,$date,$fileName,$category,$group);
           }

            
        };
        
        
    }
    public function getEditProduct($id)
    {
        return $this->editProductInfo($id);
    }

    public function editProduct($id,$info)
    {
        

        if (isset($info['image']) && $info['image']['error'] == 0)
        {
            $fileName = $info['image']['name'];
            $tempFile = $info['image']['tmp_name'];

            $timeStamp = time();
            $fileName = $timeStamp.$fileName;
            move_uploaded_file($tempFile,'../../../uploads/'.$fileName);
            $info['fileName'] = $fileName;
        };    

        return $this->updateProduct($id,$info);
    }
    

    public function deleteProduct($id)
    {
        return $this->getDeleteProduct($id);
    }

    
}
?>