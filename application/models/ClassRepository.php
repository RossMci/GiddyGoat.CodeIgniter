<?php

class ClassRepository extends CI_Model
{
    protected $table = 'class'; 

    public function record_count()
    {
        return $this->db->count_all($this->table);
    }
    function getClasses()
    {
        $commandText = "CALL getClasses()";
        $query = $this->db->query($commandText);
        return $query->result();
    }

    function getClassesByYearMonth($year, $month)
    {
        $this->db->select("*");//TODO: Check this
        $this->db->where("dateOfClass", array($year, $month));//TODO:figure out // mysql function for date range
        $query = $this->db->get($this->table);
        return $query->result();
    }
    

    function getClassById($classId)
    {
        $commandText = "CALL getClassById(?)";

        $commandParameters = array(
            'Id' => $classId
        );
        $query = $this->db->query($commandText, $commandParameters);
        return ($query->num_rows() > 0) ? $query->result()[0] : NULL;
    }
}
