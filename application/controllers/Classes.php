<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Classes extends CI_Controller
{

    public function createCalandarDataArray($classes)
    {
        $calandarData = array();
        foreach ($classes as $class) {
            $day = intval(date('d', strtotime($class->dateOfClass)));
            $calandarData[$day] =  base_url() . "index.php/Classes/viewdate/" . $class->dateOfClass;
        }
        return $calandarData;
    }

    public function getClassesForThisMonth()
    {
        $today =  date('Y-m-d');
        return $this->getClassesForMonth($today);
    }

    public function getClassesForMonth($date)
    {
        $startDate =  date('Y-m', strtotime($date)) . "-1";
        $endOfMonnth = date("t", strtotime($date));
        $endDate = date('Y-m', strtotime($date)) . "-" . $endOfMonnth;

        $this->load->model('ClassRepository');
        return  $this->ClassRepository->getClassesBetweenDates($startDate, $endDate);
    }
    public function viewdate($date)
    {
        $this->load->model('ClassRepository');
        $data = array(
            'classes' => $this->ClassRepository->getClassesByDate($date)
        );
        
        $contentData = array(
            'content' => $this->load->view('content/class_content', $data, True)
        );
        $this->load->view('classDateView', $contentData);
    }
    public function index()
    {
        $classes = $this->getClassesForThisMonth();

        $calandarData = $this->createCalandarDataArray($classes);

        var_dump($calandarData);

        $this->load->library('calendar');
        $data = array(
            'calandarHtml' => $this->calendar->generate(date('Y'), date('m'), $calandarData)
        );

        $contentData = array(
            'content' => $this->load->view('content/class_content', $data, True)
        );
        $this->load->view('class', $contentData);
    }
}
