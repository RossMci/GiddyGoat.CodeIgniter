<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fabrics extends CI_Controller {

    public function index() {
        $this->load->model('FabricRepository');
        $fabrics = $this->FabricRepository->getFabrics();

        $errors = "";
        $displayBlock = "";
        $displayBlock2 ="";
      
        foreach ($fabrics as $fabric) {

            $imageConfig = array(
                "image_library" => 'GD2', //image library
                "source_image" => '' . $fabric->image,
                "new_image" => 'assets/images/fabrics/thumbnail/' . basename($fabric->image),
                "create_thumb" => TRUE,
                "maintain_ratio" => TRUE,
                "width" => 150,
                "height" => 100
            );


            $this->load->library('image_lib', $imageConfig);
            $this->image_lib->initialize($imageConfig);

            $imageFilePath = $imageConfig["new_image"];
            if (!$this->image_lib->resize()) {
                $errors .= "<p>" . $imageConfig["new_image"] . "</p>\n";
                $errors .= $this->image_lib->display_errors();
//                $imageFilePath=$imageConfig["source_image"];
            }

                $displayBlock .= "<td><img  src=" . base_url() . $imageFilePath . "_thumb.jpg></td>\n"; //.$errors;
                  $displayBlock2 .= "<td>" . $fabric->name . "</td>\n";
        }
   

        $data = array(
            'displayBlock' => $displayBlock,
            'displayBlock2'=>$displayBlock2
        );

        $contentData = array(
            'content' => $this->load->view('content/fabrics_content', $data, True)
        );
        $this->image_lib->clear();
        $this->load->view('fabrics', $contentData);
    }

}

/* End of file  Frabrics.php */
