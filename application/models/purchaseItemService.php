<?php

class purchaseItemService extends CI_Model
{
    protected $table = 'purchase'; 

 function addpurchaseItem($purchaseItemValuesArray){
    mysqli_next_result($this->db->conn_id);
    $commandText = "CALL add_purchase(?, ?)";
    $query = $this->db->query($commandText, $purchaseItemValuesArray); //->result();    return ($query->num_rows() > 0) ? $query->result()[0] : NULL;
    if ($query->num_rows() > 0) {
        return $query->result()[0];
    } else {
        return null;
    }
 }
}
