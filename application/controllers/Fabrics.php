<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fabrics extends CI_Controller
{

    public function index()
    {
        $this->load->model('FabricRepository');
        $fabrics = $this->FabricRepository->getFabrics();

        $errors="";
        $displayBlock = "";
        foreach ($fabrics as $fabric) {

            $imageConfig = array(
                "image_library" => 'GD2', //image library
                "source_image" => './' . $fabric->image,
                "new_image" => './assets/images/fabrics/thumbnail/'. basename($fabric->image),
                "create_thumb" => TRUE,
                "maintain_ratio" => TRUE,
                "width" => 75,
                "height"=>50
            );
            	

            $this->load->library('image_lib', $imageConfig);
            $this->image_lib->initialize($imageConfig);
          
            $imageFilePath= $imageConfig["new_image"];
            if (!$this->image_lib->resize()) {
                $errors .= "<p>".$imageConfig["new_image"]."</p>\n";
                $errors .= $this->image_lib->display_errors();
                $imageFilePath=$imageConfig["source_image"];
            }
            $displayBlock .= '<img  src="' . base_url() . $imageFilePath . '" />';//.$errors;
        }

        $data = array(
            'displayBlock' => $displayBlock
        );

        $contentData = array(
            'content' => $this->load->view('content/fabrics_content', $data, True)
        );
        $this->image_lib->clear();
        $this->load->view('fabrics', $contentData);
    }
}

/* End of file  Frabrics.php */
