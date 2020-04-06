<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Task extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("task_model");
    }

    public function index()
    {
        $data['title'] = 'Task';
    }
}
