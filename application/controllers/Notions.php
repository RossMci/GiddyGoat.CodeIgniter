<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Notions extends CI_Controller
{
    public function generateNotionsThumbnails($Notions)
    {
        $this->load->library('image_lib');
        foreach ($Notions as $Notion) {
            $imageConfig = array(
                "image_library" => 'GD2', //image library
                "source_image" => './' . $Notion->image,
                "create_thumb" => TRUE,
                "maintain_ratio" => TRUE,
                "width" => 250,
                "height" => 250
            );
            $this->image_lib->initialize($imageConfig);
            $this->image_lib->resize();
            $this->image_lib->clear();
        }
        return $this->getNotionsThumbnailPaths($Notions);
    }
    public function getNotionsThumbnailPaths($Notions)
    {
        $thumbnailPaths = array();
        foreach ($Notions as $Notion) {
            $extension = strrchr($Notion->image, '.');
            $name = substr($Notion->image, 0, -strlen($extension));
            $thumbnailPath = $name . "_Thumb" . $extension;
            $thumbnailPaths[] =  $thumbnailPath;
        }
        return $thumbnailPaths;
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
    public function getNotionsTypes()
    {

        $display_block = ""; //used to build the option values for the dropdown list box 
        $commandText = "Call getNotionTypes()";
        $query = $this->db->query($commandText);
        return $query->result();

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $commandText) {  //For each entry        
                $id = $commandText['notion_type_id'];
                $display_name = stripslashes($commandText['notionTypeName']);
                //Sets the value and the text to display for the select list on the view 
                $display_block .= "<option value=\"" . $id . "\">" . $display_name . "</option>";
            }
        } else {
            $display_block .= "<option>No notionType to Select</option>";
        }
        // echo $display_block;
        return $display_block;
    }

    function viewNotions($notionid)
    {
        $this->load->model('NotionsRepository');
        $data = array(
            'notion' => $this->NotionsRepository->getNotionById($notionid)
        );
      $contentData = array(
            'content' => $this->load->view('content/notionDetails_content', $data, True)
        );

		 $this->load->view('notions', $contentData);
        }
    

    public function serach()
    {
        $notionTypeId = $this->input->get('notionTypeId');

        if (!$notionTypeId) {
            $notionTypeId = $this->uri->segment(3);
        }
        if (!$notionTypeId) {
            $this->index();
            return;
        }

        $this->load->model('NotionsRepository');
        $totalRec = count($this->NotionsRepository->getNotionsTypes($notionTypeId));


        $this->load->library('pagination');
        $per_page = 4;
        $this->pagination->initialize($this->getPaginationConfig($totalRec, $per_page, "index.php/Notions/serach/$notionTypeId/"));
        $page = $this->uri->segment(4);
        $offset = !$page ? 0 : $page;

        $notions = $this->NotionsRepository->getNotionsRangeByType($offset, $per_page, $notionTypeId);


        $thumbnailPaths = $this->generateNotionsThumbnails($notions);

        $images = array();
        for ($index = 0; $index < count($thumbnailPaths); $index++) {
            $image = '<img  src="' . base_url() . $thumbnailPaths[$index] . '" /><br><a href="">' . $notions[$index]->name . '<a/>';
            $images[] = $image;
        }

        $this->load->library('table');
        $new_list = $this->table->make_columns($images, 3);
        $imageTable = $this->table->generate($new_list);
        // $imageTable=$images;

        $data = array(
            "imageTable" => $imageTable,
            "notionTypes" => $this->NotionsRepository->getNotionsTypes()
        );

        $contentData = array(
            'content' => $this->load->view('content/notion_content', $data, True)
        );
        $this->load->view('notions', $contentData);
    }

    public function index()
    {
        $this->load->model('NotionsRepository');
        $totalRec = $this->NotionsRepository->record_count();

        $this->load->library('pagination');
        $per_page = 8;
        $this->pagination->initialize($this->getPaginationConfig($totalRec, $per_page, "index.php/Notions/index"));
        $page = $this->uri->segment(3);
        $offset = !$page ? 0 : $page;

        $Notions = $this->NotionsRepository->getNotionsRange($offset, $per_page);


        $thumbnailPaths = $this->generateNotionsThumbnails($Notions);

        $images = array();
        for ($index = 0; $index < count($thumbnailPaths); $index++) {
            $image = '<img  src="' . base_url() . $thumbnailPaths[$index] . '" /><br><a href="'.base_url().'index.php/Notions/viewNotions/'. $Notions[$index]->notion_id . '">' . $Notions[$index]->name . '</a>';
              $images[] = $image;
        }

        $this->load->library('table');
        $new_list = $this->table->make_columns($images, 3);
        $imageTable = $this->table->generate($new_list);
        // $imageTable=$images;

        $data = array(
            "imageTable" => $imageTable,
            "notionTypes" => $this->NotionsRepository->getNotionsTypes()
        );

        $contentData = array(
            'content' => $this->load->view('content/notion_content', $data, True)
        );
      
         $this->load->view('notions', $contentData);
    }
}
