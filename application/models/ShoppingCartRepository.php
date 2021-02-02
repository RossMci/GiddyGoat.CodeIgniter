<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ShoppingCartRepository extends CI_Model
{
    //protected $table = 'shopping_cart';

    public function addCart($cartValuesArray)
    {
        mysqli_next_result($this->db->conn_id);
        $commandText = "CALL AddtoCart(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $query = $this->db->query($commandText, $cartValuesArray); //->result();    return ($query->num_rows() > 0) ? $query->result()[0] : NULL;
        if ($query->num_rows() > 0) {
            return $query->result()[0];
        } else {
            return null;
        }
    }
    //TODO GetByCartsBySeesionId
    function GetCartById($id)
    {
        mysqli_next_result($this->db->conn_id);
        $commandText = "CALL GetCartById(?)";
        $query = $this->db->query($commandText, $id);
        return $query->result();
    }
    function GetCartsBySessionId($sessionId)
    {
        mysqli_next_result($this->db->conn_id);
        $commandText = "CALL GetCartsBySessionId(?)";
        $query = $this->db->query($commandText, $sessionId);
        return $query->result();
    }

    function deleteCartsBySessionId($Session_Id)
    {
        mysqli_next_result($this->db->conn_id);
        $commandText = "CALL clearShoppingCart(?)";
        $query = $this->db->query($commandText, $Session_Id);
        return $query;
    }
}
