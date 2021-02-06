<?php

class ClassRepository extends CI_Model
{
    // protects the class table
    protected $table = 'class'; 
    // counts all the records that are used in pagination
    public function record_count()
    {
        return $this->db->count_all($this->table);
    }
    // gets the all the classes from the database
    function getClasses()
    {
        $commandText = "CALL getClasses()";
        $query = $this->db->query($commandText);
        return $query->result();
    }

   //gets all the classes by data from the data base 
    function getClassesByDate($date)
    {
        $this->db->select("*");
        $this->db->where('dateOfClass', date('Y-m-d', strtotime($date)));
        $query = $this->db->get($this->table);
        return $query->result();
    }
    // gets all the class between certain dates
    function getClassesBetweenDates($startDate, $endDate)
    {
        $this->db->select("*");
        $this->db->where('dateOfClass BETWEEN "'. date('Y-m-d', strtotime($startDate)). '" and "'. date('Y-m-d', strtotime($endDate)).'"');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
// gets the classes by id from the data base 
    function getClassById($classId)
    {
        $commandText = "CALL GetClassById(?)";

        $commandParameters = array(
            'Id' => $classId
        );
        $query = $this->db->query($commandText, $commandParameters);
        return ($query->num_rows() > 0) ? $query->result()[0] : NULL;
    }
// stores the booked classes in the database
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
    //handles the checkout of books for class and stores info in the database.
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
