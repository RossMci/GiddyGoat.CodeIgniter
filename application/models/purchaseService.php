<?php

class purchaseService extends CI_Model
{
    protected $table = 'purchase'; 

    // used to add purchase too the database 
 function addpurchase($purchaseValuesArray){
    mysqli_next_result($this->db->conn_id);
    $commandText = "CALL add_purchase(?)";
    $query = $this->db->query($commandText, $purchaseValuesArray); //->result();    return ($query->num_rows() > 0) ? $query->result()[0] : NULL;
        return $query->result()[0];

 }
}
