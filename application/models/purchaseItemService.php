<?php

class purchaseItemService extends CI_Model
{
    protected $table = 'purchase';

    function addpurchaseItem($purchaseItemValuesArray)
    {
        mysqli_next_result($this->db->conn_id);
        $commandText = "CALL AddtoPurchaseDetails(?,?,?,?,?,?)";
        $this->db->query($commandText, $purchaseItemValuesArray);
    }
}
