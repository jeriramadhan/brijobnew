<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require('./vendor/autoload.php');

// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Task extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model("task_model");
        $this->load->library('pdf');
    }

    public function index()
    {
        $data['title'] = 'List Task';
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $nama = $user['name'];
        $data['kerjaan'] = $this->task_model->getKerjaanUser($nama);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('task-user/listtask', $data);
        $this->load->view('templates/footer');
    }
}
