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
            return $query->result_array();
        } else {
            return false;
        }
    }
    //TODO GetByCartsBySeesionId
    function GetByCartsBySessionId($SessionId)
    {
        var_dump($_POST);
        mysqli_next_result($this->db->conn_id);
        $commandText = "CALL GetCartById(?)";
        $query = $this->db->query($commandText, $SessionId);
        var_dump($commandText);
        return ($query->num_rows() > 0) ? $query->result()[0] : NULL;
    }
}
