<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Fabrics extends CI_Controller
{

    // genrates the fabric thumbnails that used in the fabric table
    public function generateFabricThumbnails($fabrics)
    {
        $this->load->library('image_lib');
        foreach ($fabrics as $fabric) {
            $imageConfig = array(
                "image_library" => 'GD2', //image library
                "source_image" => './' . $fabric->image,
                "create_thumb" => TRUE,
                "maintain_ratio" => TRUE,
                "width" => 250,
                "height" => 250
            );
            $this->image_lib->initialize($imageConfig);
            $this->image_lib->resize();
            $this->image_lib->clear();
        }
        return $this->getFabricThumbnailPaths($fabrics);
    }
    // gets the paths for the thumbnails
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

    // configures the pagination used on the fabric page 
    public function getPaginationConfig($total_rows, $per_page, $pageUri)
    {
        $config['base_url'] = base_url() . $pageUri;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '« First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last »';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next →';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '← Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';
        $config['base_url'] = base_url() . $pageUri;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '« First';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last »';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Next →';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '← Previous';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

        return $config;
    }
    // gets the fabric types to be used in the serach function
    public function getFabricTypes()
    {

        $display_block = ""; //used to build the option values for the dropdown list box 
        $commandText = "Call getFabricTypes()";
        $query = $this->db->query($commandText);
        return $query->result();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $commandText) {  //For each entry        
                $id = $commandText['fabric_type_id'];
                $display_name = stripslashes($commandText['fabricTypeName']);
                //Sets the value and the text to display for the select list on the view 
                $display_block .= "<option value=\"" . $id . "\">" . $display_name . "</option>";
            }
        } else {
            $display_block .= "<option>No FabricType to Select</option>";
        }
        // echo $display_block;
        return $display_block;
    }
// loads the clicked fabric 
    function viewFabric($fabricid)
    {
        $this->load->model('FabricRepository');
        $data = array(
            'fabric' => $this->FabricRepository->getFabricById($fabricid)
        );
      $contentData = array(
            'content' => $this->load->view('content/fabricDetails_content', $data, True)
        );

		 $this->load->view('fabrics', $contentData);
        }
    
  // used to serach for the fabric types you want
    public function serach()
    {
        $fabricTypeId = $this->input->get('fabricTypeId');

        if (!$fabricTypeId) {
            $fabricTypeId = $this->uri->segment(3);
        }
        if (!$fabricTypeId) {
            $this->index();
            return;
        }

        $this->load->model('FabricRepository');
        $totalRec = count($this->FabricRepository->getFabricsByType($fabricTypeId));


        $this->load->library('pagination');
        $per_page = 4;
        $this->pagination->initialize($this->getPaginationConfig($totalRec, $per_page, "index.php/Fabrics/serach/$fabricTypeId/"));
        $page = $this->uri->segment(4);
        $offset = !$page ? 0 : $page;

        $fabrics = $this->FabricRepository->getFabricRangeByType($offset, $per_page, $fabricTypeId);


        $thumbnailPaths = $this->generateFabricThumbnails($fabrics);

        $images = array();
        for ($index = 0; $index < count($thumbnailPaths); $index++) {
            $image = '<img  src="' . base_url() . $thumbnailPaths[$index] . '" /><br><a href="">' . $fabrics[$index]->name . '<a/>';
            $images[] = $image;
        }

        $this->load->library('table');
        $new_list = $this->table->make_columns($images, 3);
        $imageTable = $this->table->generate($new_list);
        // $imageTable=$images;

        $data = array(
            "imageTable" => $imageTable,
            "fabricTypes" => $this->FabricRepository->getFabricTypes()
        );

        $contentData = array(
            'content' => $this->load->view('content/fabrics_content', $data, True)
        );
        $this->load->view('fabrics', $contentData);
    }

// loads the fabric view intaily 
    public function index()
    {
        $this->load->model('FabricRepository');
        $totalRec = $this->FabricRepository->record_count();

        $this->load->library('pagination');
        $per_page = 8;
        $this->pagination->initialize($this->getPaginationConfig($totalRec, $per_page, "index.php/Fabrics/index"));
        $page = $this->uri->segment(3);
        $offset = !$page ? 0 : $page;

        $fabrics = $this->FabricRepository->getFabricRange($offset, $per_page);


        $thumbnailPaths = $this->generateFabricThumbnails($fabrics);

        $images = array();
        for ($index = 0; $index < count($thumbnailPaths); $index++) {
            $image = '<img  src="' . base_url() . $thumbnailPaths[$index] . '" /><br><a href="'.base_url().'index.php/Fabrics/viewFabric/'. $fabrics[$index]->fabric_id . '">' . $fabrics[$index]->name . '</a>';
              $images[] = $image;
        }

        $this->load->library('table');
        $new_list = $this->table->make_columns($images, 3);
        $imageTable = $this->table->generate($new_list);
        // $imageTable=$images;

        $data = array(
            "imageTable" => $imageTable,
            "fabricTypes" => $this->FabricRepository->getFabricTypes()
        );

        $contentData = array(
            'content' => $this->load->view('content/fabrics_content', $data, True)
        );
        $this->load->view('fabrics', $contentData);
    }
}
