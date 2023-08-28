<?php
include_once __DIR__ . '/../model/Group.php';

class GroupController extends Group
{
    public function getGroup()
    {
        return $this->getGroupList();
    }

    public function addGroup($name, $image)
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
                  return $this->createGroup($name,$filename);
              }
          }
      }
    }

    public function getGroupId($id)
    {
        return $this->getGroupInfo($id);
    }

    public function editGroup($id, $name, $image)
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
                  return $this->updateGroup($id,$name,$filename);
              }
          }
      }

       
    }

    public function deleteGroup($id)
    {
        return $this->deleteGroupInfo($id);
    }
}
