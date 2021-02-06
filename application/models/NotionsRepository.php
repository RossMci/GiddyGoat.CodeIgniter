<?php

class NotionsRepository extends CI_Model
{
    protected $table = 'notions'; 
   // counts all the notions for pagination
    public function record_count()
    {
        return $this->db->count_all("notions");
    }
    // gets all the notions from the database 
    function Notionsget()
    {
        $commandText = "CALL getNotions()";
        $query = $this->db->query($commandText);
        return $query->result();
    }

    //gets all the notions in a range to be used in pagination 
    function getNotionsRange($start, $limit)
    {
        $this->db->limit($limit, $start);
        $this->db->select("notion_id, name, image");
        $query = $this->db->get('notions');
        return $query->result();
    }

    //gets  the notions by type for the search
    function NotionsByType($notionstypeId)
    {
        $this->db->select("notion_id, name, image");
        $this->db->where("notion_type_id", $notionstypeId);
        $query = $this->db->get('notions');
        return $query->result();
    }
    // gets the types in a range for pagination
    function getNotionsRangeByType($start, $limit, $notionstypeId)
    {
        $this->db->limit($limit, $start);
        $this->db->select("notion_id, name, image");
        $this->db->where("notion_type_id", $notionstypeId);
        $query = $this->db->get('notions');
        return $query->result();
    }
// gets the notion types for the dropdowns
    public function getNotionsTypes()
    {
        $commandText = "Call getNotionTypes()";
        $query = $this->db->query($commandText);
        mysqli_next_result($this->db->conn_id);
        return $query->result();
    }
    // gets notions by id 
    function getNotionById($notionid)
    {
        $commandText = "CALL GetNotionById(?)";

        $commandParameters = array(
            'notionid' => $notionid
        );
        $query = $this->db->query($commandText, $commandParameters);
        return ($query->num_rows() > 0) ? $query->result()[0] : NULL;
    }
}
