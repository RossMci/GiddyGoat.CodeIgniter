<?php

class FabricRepository extends CI_Model {

    protected $table = 'fabric';

    function getFabrics() {
        $displayBlock = "";
        $commandText = "CALL getFabrics()";
//        $query = $this->db->get($this->table);
        $query = $this->db->query($commandText);
        $row = $query->row();
        if (isset($row)) {
            $config['image_library'] = 'GD2'; //image library
            $config['source_image'] = $row->image;  //the image



            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
//thumbnail size
            $config['width'] = 75;
            $config['height'] = 50;
            $this->load->library('image_lib', $config); //load with config
            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors();
            }
            $displayBlock .= "<img src=" . base_url() .$row->image .">";
            
//            return $query->result();
            return $displayBlock;
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
