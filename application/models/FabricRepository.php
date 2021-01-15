<?php

class FabricRepository extends CI_Model
{
    protected $table = 'fabric'; 

    public function record_count()
    {
        return $this->db->count_all("fabric");
    }
    function getFabrics()
    {
        $commandText = "CALL getFabrics()";
        $query = $this->db->query($commandText);
        return $query->result();
    }
    function getFabricRange($start, $limit)
    {
        $this->db->limit($limit, $start);
        $this->db->select("fabric_id, name, image");
        $query = $this->db->get('fabric');
        return $query->result();
    }

    function getFabricsByType($fabricTypeId)
    {
        $this->db->select("fabric_id, name, image");
        $this->db->where("Fabric_Type_Id", $fabricTypeId);
        $query = $this->db->get('fabric');
        return $query->result();
    }
    
    function getFabricRangeByType($start, $limit, $fabricTypeId)
    {
        $this->db->limit($limit, $start);
        $this->db->select("fabric_id, name, image");
        $this->db->where("Fabric_Type_Id", $fabricTypeId);
        $query = $this->db->get('fabric');
        return $query->result();
    }

    public function getFabricTypes()
    {
        $commandText = "Call getFabricTypes()";
        $query = $this->db->query($commandText);
        return $query->result();
    }
    function getFabricById($fabricId)
    {
        $commandText = "CALL GetFabricById(?)";

        $commandParameters = array(
            'fabricId' => $fabricId
        );
        $query = $this->db->query($commandText, $commandParameters);
        return ($query->num_rows() > 0) ? $query->result()[0] : NULL;
    }
}
