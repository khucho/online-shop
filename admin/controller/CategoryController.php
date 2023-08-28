<?php

include_once __DIR__.'/../model/Category.php';


class CategoryController extends Category{

    public function getCategories()
    {
      return  $this->getCategoriesList();  
    }

    public function addCategory($name,$image)
    {
         if($image['error'] == 0)
        {
            $filename = $image['name'];
            $extension = explode('.',$filename);
            $filetype = end($extension);
            $filesize = $image['size'];
            $allowed_types = ['jpg','jpeg','svg','png'];
            $tmp_file = $image['tmp_name'];
            if(in_array($filetype,$allowed_types))
            {
                if($filesize >= 20000)
                {
                    $timestamp =time();
                    $filename = $timestamp.$filename;
                    if(move_uploaded_file($tmp_file,'../../../uploads/'.$filename))
                    return $this->createCategory($name,$filename);
                }
            }
        }
          
      }

    public function getCategory($id)
    {
      return $this->getCategoryInfo($id);
    }

    public function editCategory($id,$name,$image)
    {
      if($image['error'] == 0)
      {
          $filename = $image['name'];
          $extension = explode('.',$filename);
          $filetype = end($extension);
          $filesize = $image['size'];
          $allowed_types = ['jpg','jpeg','svg','png'];
          $tmp_file = $image['tmp_name'];
          if(in_array($filetype,$allowed_types))
          {
              if($filesize >= 2000)
              {
                  $timestamp =time();
                  $filename = $timestamp.$filename;
                  if(move_uploaded_file($tmp_file,'../../../uploads/'.$filename))
                  return $this->updateCategory($id,$name,$filename);
              }
          }
      }
    }

    public function deleteCategory($id)
    {
      return $this->deleteCategoryInfo($id);
    }

    public function categoryPerProduct()
    {
      return $this->getCategoryPerProduct();
    }
}

?>