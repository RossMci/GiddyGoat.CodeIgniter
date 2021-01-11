<?php

class FabricRepository extends CI_Model {

    protected $table = 'fabric';

    public function record_count()
	{
		return $this->db->count_all("fabric");
	}

    //TODO:  getFabrics($start, $limit) 
    function getFabrics($start,$limit) : array
    {
        $this->db->limit($limit, $start);
        $commandText = "CALL getFabrics()";
        $query = $this->db->query($commandText);
        if ($query->num_rows() > 0)
		{
        return $query->result();
        }
        else 
        {
            return false;
        }
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
