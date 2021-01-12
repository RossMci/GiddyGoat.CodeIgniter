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
        $this->db->select("name, image");
        $query = $this->db->get('fabric');
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

    function getFabricsByType($fabricType)
    {
        $fabricdisplay = "";
        $commandText = "CALL GetFabricsByType(?)";

        $commandParameters = array(
            'fabricType' => $fabricType
        );
        $query = $this->db->query($commandText, $commandParameters);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $type) {  //For each entry    
                $id = $type['master_id'];
                $display_name = stripslashes($type['display_name']);
                //Sets the value and the text to display for the select list on the view 
                $fabricdisplay .= "<option value=\"" . $id . "\">" . $display_name . "</option>";
            }
            //return $query->result();
        }
    }
}
