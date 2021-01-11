<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fabrics extends CI_Controller
{


    

    public function index()
    {
        $this->load->model('FabricRepository');
        $fabrics = $this->FabricRepository->getFabrics();

        $errors = "";
        $displayBlock = "";
        $displayBlock2 = "";

        foreach ($fabrics as $fabric) {

            $extension = strrchr($fabric->image , '.');
            $name = substr($fabric->image , 0, -strlen($extension));
            $thumbnailPath = $name."_Thumb".$extension;

            $imageConfig = array(
                "image_library" => 'GD2', //image library
                "source_image" => './' . $fabric->image,
                //"new_image" => './assets/images/fabrics/thumbnail/',
                "create_thumb" => TRUE,
                "maintain_ratio" => TRUE,
                "width" => 150,
                "height" => 150
            );


            $this->load->library('image_lib', $imageConfig);
            $this->image_lib->initialize($imageConfig);

            if (!$this->image_lib->resize()) {
                $errors .= $this->image_lib->display_errors();
            }

            $displayBlock .= '<td><img  src="' . base_url() . $thumbnailPath . '"></td>' . $errors;
            $displayBlock2 .= "<td>" . $fabric->name . "</td>\n";
        }


        $data = array(
            'displayBlock' => $displayBlock,
            'displayBlock2' => $displayBlock2
        );

        $contentData = array(
            'content' => $this->load->view('content/fabrics_content', $data, True)
        );
        $this->image_lib->clear();
        $this->load->view('fabrics', $contentData);
    }
}

/* End of file  Frabrics.php */
