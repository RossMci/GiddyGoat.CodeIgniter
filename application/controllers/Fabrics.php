<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fabrics1 extends CI_Controller
{

    public function index()
    {
        $this->load->model('FabricRepository');

        $data = array(
            "name" => "test",
            'fabrics' => $this->FabricRepository->getFabrics()
        );

        $contentData['mycontent']= "<h1>abc</h1>";//.$this->load->view('content/fabrics_content', $data, True)

        var_dump($contentData);
        $this->load->view('fabrics', $contentData);
    }
}
        
    /* End of file  Frabrics.php */
