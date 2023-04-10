<?php

include_once '../lib/Database.php';
include_once '../helpers/Format.php';

class Add
{
    public $db;
    public $fr;
    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function AddItem($data)
    {
        $item = $this->fr->validation($data['item']);
        $date = date('Y-m-d H:i:s');

        if (empty($item)) {
            $error = 'Field must not be empty';
            return $error;
        } else {
            // Item Duplicate check 
            $item_query = "SELECT `name` FROM `item_details` WHERE `name` = '$item'";
            $check_query = $this->db->select($item_query);

            //check condition 
            if ($check_query > '0') {
                $error = 'Item Already Exists';
                return $error;
            } else {
                $insert_query = "INSERT INTO `item_details` (`name`,`created_at`) VALUES ('$item','$date')";
                $insert_row = $this->db->insert($insert_query);
                if ($insert_row) {
                    $success = 'Item Added Successfully';
                    return $success;
                } else {
                    $error = 'Something went wrong';
                    return $error;
                }
            }
        }
    }

    // Show List item 

    public function ItemList()
    {
        $select_item = "SELECT * FROM `item_details`";
        $all_item = $this->db->select($select_item);
        if ($all_item != false) {
            return $all_item;
        } else {
            return false;
        }
    }

    public function getItemData($id)
    {
        $edit_data = "SELECT * FROM `item_details` WHERE `id` = '$id'";
        $edit_result = $this->db->select($edit_data);
        return $edit_result;
    }

    // update item

    public function UpdateItem($data, $id)
    {
        $item = $this->fr->validation($data['item']);
        $date = date('Y-m-d H:i:s');

        if (empty($item)) {
            $error = 'Field must not be empty';
            return $error;
        } else {
            // Item Duplicate check 
            $update_query = "UPDATE `item_details` SET `name` = '$item'  ,`created_at` = '$date' WHERE id = '$id'";
            $update_query = $this->db->update($update_query);

            //check condition 
            if($update_query){
                $success = 'Item Update Successfully';
                header('location: add.php');
                return $success;
            }else {
                $error = 'Something went wrong';
                return $error;
            }
        }


    }

    // delete item 

    public function DeleteItem($id){

        $delete_query  = "DELETE FROM `item_details` WHERE id = '$id'";
        $result_delete = $this->db->delete($delete_query);
        if($result_delete){
            $success = 'Item Delete Successfully';
            return $success;
        }else{
            $error = 'Something went wrong';
            return $error;
        }

    }

}


?>