<?php

class purchaseItemService extends CI_Model
{
    protected $table = 'purchase';
   // adds the item purchase too the  PurchaseDetails table
    function addpurchaseItem($purchaseItemValuesArray)
    {
        mysqli_next_result($this->db->conn_id);
        $commandText = "CALL AddtoPurchaseDetails(?,?,?,?,?,?)";
        $this->db->query($commandText, $purchaseItemValuesArray);
    }
}
