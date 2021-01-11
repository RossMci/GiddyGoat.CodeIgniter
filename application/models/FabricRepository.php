<?php

class FabricRepository extends CI_Model {

    protected $table = 'fabric';

    function getFabrics() : array
    {
        $commandText = "CALL getFabrics()";
        $query = $this->db->query($commandText);
        return $query->result();
    }
    function getFabricById($fabricId) {
        $commandText = "CALL GetFabricById(?)";

        $commandParameters = array(
            'fabricId' => $fabricId
        );
        $query = $this->db->query($commandText, $commandParameters);
        return ($query->num_rows() > 0) ? $query->result()[0] : NULL;
    }

    function getFabricsByType($fabricType) {
        $commandText = "CALL GetFabricsByType(?)";

        $commandParameters = array(
            'fabricType' => $fabricType
        );
        $query = $this->db->query($commandText, $commandParameters);
        return $query->result();
    }

}
