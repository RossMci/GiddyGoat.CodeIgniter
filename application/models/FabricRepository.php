<?php

class FabricRepository extends CI_Model
{
   // protects the fabric table 
    protected $table = 'fabric'; 
// counts all the fabrics for pagination
    public function record_count()
    {
        return $this->db->count_all("fabric");
    }
    // gets all the fabrics from the database 
    function getFabrics()
    {
        $commandText = "CALL getFabrics()";
        $query = $this->db->query($commandText);
        return $query->result();
    }
    // gets the fabrics in a range to be used when displayed (pagination)
    function getFabricRange($start, $limit)
    {
        $this->db->limit($limit, $start);
        $this->db->select("fabric_id, name, image");
        $query = $this->db->get('fabric');
        return $query->result();
    }
   //gets the fabrics by type 
    function getFabricsByType($fabricTypeId)
    {
        $this->db->select("fabric_id, name, image");
        $this->db->where("Fabric_Type_Id", $fabricTypeId);
        $query = $this->db->get('fabric');
        return $query->result();
    }
        // gets the fabrics in a range to be used when displayed (pagination) but with types this time when search function is used
    function getFabricRangeByType($start, $limit, $fabricTypeId)
    {
        $this->db->limit($limit, $start);
        $this->db->select("fabric_id, name, image");
        $this->db->where("Fabric_Type_Id", $fabricTypeId);
        $query = $this->db->get('fabric');
        return $query->result();
    }
  // (names) gets all the types too be used in the drop down
    public function getFabricTypes()
    {
        $commandText = "Call getFabricTypes()";
        $query = $this->db->query($commandText);
        return $query->result();
    }
    // gets the fabrics by id 
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
