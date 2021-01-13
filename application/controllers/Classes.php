<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Classes extends CI_Controller
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
                "width" => 250,
                "height" => 250
            );
            $this->image_lib->initialize($imageConfig);
            $this->image_lib->resize();
            $this->image_lib->clear();
        }
        return $this->getFabriccalandarData($fabrics);
    }
    public function getCalanderClasses($classes)
    {
        $calandarData = array();
        foreach ($classes as $class) {
            $calandarData[dayOfMonth($class->dateOfClass)] =  base_url()+ "index.php/Classes/"+$class->id;//TODO: find dayofMonth function link too ckas
        }
        return $calandarData;
    }

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

    function selectedFabricDisplay()
    {
        if ($this->input->post('submit')) {

            $data['display_block2'] = "";

            $master_id = $this->input->post('master_id');

            $this->load->model('AddressBook');


            $data['display_block2'] = $this->AddressBook->getSelectedContact($master_id);
            //                    Select all contacts in the addressbook
            $data['display_block'] = $this->AddressBook->selectContacts();

            //View the selected contacts dropdown            
            $this->load->view('SelectEntry', $data);
        }
    }

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
        $per_page = 3;
        $this->pagination->initialize($this->getPaginationConfig($totalRec, $per_page, "index.php/Fabrics/serach/$fabricTypeId/"));
        $page = $this->uri->segment(4);
        $offset = !$page ? 0 : $page;

        $fabrics = $this->FabricRepository->getFabricRangeByType($offset, $per_page, $fabricTypeId);


        $calandarData = $this->generateFabricThumbnails($fabrics);

        $images = array();
        for ($index = 0; $index < count($calandarData); $index++) {
            $image = '<img  src="' . base_url() . $calandarData[$index] . '" /><br><a href="">' . $fabrics[$index]->name . '<a/>';
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

    public function index()
    {
        $this->load->model('FabricRepository');
        $totalRec = $this->FabricRepository->record_count();

        $this->load->library('pagination');
        $per_page = 6;
        $this->pagination->initialize($this->getPaginationConfig($totalRec, $per_page, "index.php/Fabrics/index"));
        $page = $this->uri->segment(3);
        $offset = !$page ? 0 : $page;

        $fabrics = $this->FabricRepository->getFabricRange($offset, $per_page);


        $calandarData = $this->generateFabricThumbnails($fabrics);

        $images = array();
        for ($index = 0; $index < count($calandarData); $index++) {
            $image = '<img  src="' . base_url() . $calandarData[$index] . '" /><br><a href="">' . $fabrics[$index]->name . '<a/>';
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
