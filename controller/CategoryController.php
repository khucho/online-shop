<?php
include_once __DIR__.'/../model/Category.php';


class CategoryController extends Category
{
    public function allCategories()
    {
        return $this->getallCategories();
    }
}
?>