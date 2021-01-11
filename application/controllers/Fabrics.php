<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fabrics extends CI_Controller
{
    public function generateFabricThumbnails($fabrics)
    {
        $this->load->library('image_lib');
        foreach ($fabrics as $fabric) {
            $imageConfig = array(
                "image_library" => 'GD2', //image library
                "source_image" => './' . $fabric->image,
                "create_thumb" => TRUE,
                "maintain_ratio" => TRUE,
                "width" => 150,
                "height" => 150
            );
            $this->image_lib->initialize($imageConfig);
            $this->image_lib->resize();
            $this->image_lib->clear();
        }
        return $this->getFabricThumbnailPaths($fabrics);
    }
    public function getFabricThumbnailPaths($fabrics)
    {
        $thumbnailPaths = array();
        foreach ($fabrics as $fabric) {
            $extension = strrchr($fabric->image, '.');
            $name = substr($fabric->image, 0, -strlen($extension));
            $thumbnailPath = $name . "_Thumb" . $extension;
            $thumbnailPaths[] =  $thumbnailPath; 
        }
        return $thumbnailPaths;
    }

    public function index()
    {
        $this->load->model('FabricRepository');

        $fabrics = $this->FabricRepository->getFabrics();
        $thumbnailPaths = $this->generateFabricThumbnails($fabrics);

        $images = array();
        for ($index = 0; $index < count($thumbnailPaths); $index++) {
            $image = '<img  src="' . base_url() . $thumbnailPaths[$index] . '" /><br/>' . $fabrics[$index]->name;
            $images[] = $image;
        }

        $this->load->library('table');
        $new_list = $this->table->make_columns($images, 3);
        $imageTable = $this->table->generate($new_list);

        $data = array(
            "imageTable" => $imageTable,
        );

        $contentData = array(
            'content' => $this->load->view('content/fabrics_content', $data, True)
        );
        $this->load->view('fabrics', $contentData);
    }
}

/* End of file  Frabrics.php */
