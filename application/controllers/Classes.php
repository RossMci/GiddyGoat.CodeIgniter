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
            'content' => $this->load->view('content/classDateView_content', $data, True)
        );
        $this->load->view('classDateView', $contentData);
        // $this->load->view('class', $contentData);
    }
    public function tableConfig()
    {
        $prefs['template'] = '

        {table_open}<table border="5" cellpadding="10" cellspacing="20">{/table_open}

        {heading_row_start}<tr>{/heading_row_start}

        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr>{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr>{/cal_row_start}
        {cal_cell_start}<td>{/cal_cell_start}
        {cal_cell_start_today}<td>{/cal_cell_start_today}
        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
        {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

        {cal_cell_blank}&nbsp;{/cal_cell_blank}

        {cal_cell_other}{day}{/cal_cel_other}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_cell_end_other}</td>{/cal_cell_end_other}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}
';
        return $prefs;
    }
    public function index()
    {
        $classes = $this->getClassesForThisMonth();

        $calandarData = $this->createCalandarDataArray($classes);

        // var_dump($calandarData);

        $this->load->library('calendar', $this->tableConfig());
        $data = array(
            'calandarHtml' => $this->calendar->generate(date('Y'), date('m'), $calandarData)
        );

        $contentData = array(
            'content' => $this->load->view('content/class_content', $data, True)
        );
        $this->load->view('class', $contentData);
    }
}
