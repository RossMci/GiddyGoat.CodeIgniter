<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ShoppingCartRepository extends CI_Model
{
    //protected $table = 'shopping_cart';

    public function addCart($cartValuesArray)
    {
        mysqli_next_result($this->db->conn_id);
        $commandText = "CALL AddtoCart(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        return $this->db->query($commandText, $cartValuesArray);//->result();
    }
    //TODO GetByCartsBySeesionId
}
