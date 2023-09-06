<?php
include_once __DIR__ . '/../model/Search.php'; 

class SearchController extends SearchModel
{
    public function searchProduct($searchQuery)
    {
        return $this->searchProducts($searchQuery);
    }
}
?>
