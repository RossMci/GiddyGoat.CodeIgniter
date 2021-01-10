<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fabrics extends CI_Controller
{

    public function index()
    {
        $this->load->model('FabricRepository');
        $data = array(
            'fabrics' => $this->FabricRepository->getFabrics(),
             
        );
        
         $contentData = array(
          'content' => $this->load->view('content/fabrics_content', $data, True)
        );

//        $contentData['content']=$this->load->view('content/fabrics_content', $data, True);

//        var_dump($contentData);
        $this->load->view('fabrics', $contentData);
    }
}
        
    /* End of file  Frabrics.php */
