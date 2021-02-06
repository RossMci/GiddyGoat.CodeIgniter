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

    function getClassesByDate($date)
    {
        $this->db->select("*");//TODO: Check this
        $this->db->where('dateOfClass', date('Y-m-d', strtotime($date)));
        $query = $this->db->get($this->table);
        return $query->result();
    }
    function getClassesBetweenDates($startDate, $endDate)
    {
        $this->db->select("*");//TODO: Check this
        $this->db->where('dateOfClass BETWEEN "'. date('Y-m-d', strtotime($startDate)). '" and "'. date('Y-m-d', strtotime($endDate)).'"');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    

    function getClassById($classId)
    {
        $commandText = "CALL GetClassById(?)";

        $commandParameters = array(
            'Id' => $classId
        );
        $query = $this->db->query($commandText, $commandParameters);
        return ($query->num_rows() > 0) ? $query->result()[0] : NULL;
    }

    function BookClass($BookValuesArray){
        mysqli_next_result($this->db->conn_id);
        $commandText = "CALL Bookclass(?,?,?,?)";
        $query = $this->db->query($commandText,$BookValuesArray);
        if ($query->num_rows() > 0) {
            return $query->result()[0];
        } else {
            return null;
        }

    }
    function CheckoutBookedClass($CheckoutBookValuesArray){
        mysqli_next_result($this->db->conn_id);
        $commandText = "CALL CheckoutBookedClass(?,?,?)";
        $query = $this->db->query($commandText,$CheckoutBookValuesArray);
        if ($query->num_rows() > 0) {
            return $query->result()[0];
        } else {
            return null;
        }

    }
}
