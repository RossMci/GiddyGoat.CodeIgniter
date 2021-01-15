<?php

class NotionsRepository extends CI_Model
{
    protected $table = 'notions'; 

    public function record_count()
    {
        return $this->db->count_all("notions");
    }
    function Notionsget()
    {
        $commandText = "CALL getNotions()";
        $query = $this->db->query($commandText);
        return $query->result();
    }
    function getNotionsRange($start, $limit)
    {
        $this->db->limit($limit, $start);
        $this->db->select("notion_id, name, image");
        $query = $this->db->get('notions');
        return $query->result();
    }

    function NotionsByType($notionstypeId)
    {
        $this->db->select("notion_id, name, image");
        $this->db->where("notion_type_id", $notionstypeId);
        $query = $this->db->get('notions');
        return $query->result();
    }
    
    function getNotionsRangeByType($start, $limit, $notionstypeId)
    {
        $this->db->limit($limit, $start);
        $this->db->select("notion_id, name, image");
        $this->db->where("notion_type_id", $notionstypeId);
        $query = $this->db->get('notions');
        return $query->result();
    }

    public function getNotionsTypes()
    {
        $commandText = "Call getNotionTypes()";
        $query = $this->db->query($commandText);
        mysqli_next_result($this->db->conn_id);
        return $query->result();
    }
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
