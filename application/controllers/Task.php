<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Task extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model("task_model");
    }

    public function index()
    {
        $data['title'] = 'List Task';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data["task"] = $this->task_model->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('task/listtask', $data);
        $this->load->view('templates/footer');
    }

    public function createTask()
    {
        $data['title'] = 'Create Task';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['getUser'] = $this->task_model->getAllUser();

        $task = $this->task_model;
        $validation = $this->form_validation;
        $validation->set_rules($task->rules());

        // if ('dateinput == datenow') {
        //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Duration task is still 3 days left!</div>');
        // } elseif ('dateinput == (datenow - 1)') {
        //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Duration task is still 2 days left!</div>');
        // } else {
        //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Duration task is still 1 days left!</div>');
        // }

        if ($validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('task/createtask', $data);
            $this->load->view('templates/footer');
        } else {
            $task->save();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Create task has been saved!</div>');
            redirect('task');
        }
    }

    public function listTask()
    {
        $data['title'] = 'List Task';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/listtask', $data);
        $this->load->view('templates/footer');
    }

    // public function edit($id = null)
    // {
    //     $data['title'] = 'Update';
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['getUser'] = $this->task_model->getAllUser();

    //     if (!isset($id)) redirect('task');

    //     $task = $this->task_model;
    //     $validation = $this->form_validation;
    //     $validation->set_rules($task->rules());


    //     if ($validation->run()) {
    //         $task->update();
    //         $this->session->set_flashdata('success', 'Berhasil disimpan');
    //     }


    //     $data["task"] = $task->getById($id);
    //     if (!$data["task"]) show_404();
    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar', $data);
    //     $this->load->view('templates/topbar', $data);
    //     $this->load->view('task/edit', $data);
    //     $this->load->view('templates/footer');

    //     // $this->load->view("task/edit", $data);
    // }


    public function editTask($id)
    {
        $data['title'] = 'Update';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        // $this->load->model('Task_model', 'update');

        $where = array('id' => $id);
        $data['progress'] = $this->task_model->ambil_where($where, 'user_task')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('task/update', $data);
        $this->load->view('templates/footer');

        // $this->form_validation->set_rules('progress', 'Progress', 'required|trim');
        // $this->form_validation->set_rules('status', 'Status');


        // if ($this->form_validation->run() == false) {
        //     $this->load->view('templates/header', $data);
        //     $this->load->view('templates/sidebar', $data);
        //     $this->load->view('templates/topbar', $data);
        //     $this->load->view('task/update', $data);
        //     $this->load->view('templates/footer');
        // } else {
        //     $progress = $this->input->post('progress');
        //     $name = $this->input->post('name');
        //     // 'status' => $this->input->post('status')

        //     $this->db->set('progress', $progress);
        //     $this->db->where('name', $name);
        //     $this->db->update('user_task');

        //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update has been saved!</div>');
        //     redirect('task');
        // }
    }

    public function updateTask()
    {
        $id = $this->input->post('id');
        $progress = $this->input->post('progress');
        $info = $this->input->post('info');

        $data = array(
            'progress' => $progress,
            'info' => $info
        );

        $where = array('id' => $id);

        $this->task_model->update($where, $data, 'user_task');
        redirect('task');
    }

    public function delete($id = null)
    {
        if (!isset($id)) show_404();

        if ($this->task_model->delete($id)) {
            redirect(site_url('task/listtask'));
        }
    }

    public function requesttask()
    {
        $data['title'] = 'Request Task';
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $nama = $user['name'];
        $data['kerjaan'] = $this->task_model->getKerjaanUser($nama);

        // $data['approve'] = $this->db->get('user_task')->result_array();

        // if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('task/requesttask', $data);
        $this->load->view('templates/footer');
        // } else {
        //     $this->db->update('user_task', ['approve' => $this->input->post('approve')]);
        //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update has been saved!</div>');
        //     redirect('task/requesttask');
        // }
    }

    public function accept($id)
    {
        $data['title'] = 'Request Task';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        // $this->load->model('Task_model', 'update');

        $where = array('id' => $id);
        $data['approve'] = $this->task_model->ambil_where($where, 'user_task')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('task/accept', $data);
        $this->load->view('templates/footer');
    }

    public function updateaccept()
    {
        $id = $this->input->post('id');
        $approve = $this->input->post('approve');

        $data = array(
            'approve' => $approve
        );

        $where = array('id' => $id);

        $this->task_model->update($where, $data, 'user_task');
        redirect('task/requesttask');
    }

    public function print()
    {
        $data['task'] = $this->task_model->getAll();
        $this->load->view('task/printtask', $data);
    }

    public function excel()
    {
        $data['task'] = $this->task_model->getAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', '#')
            ->setCellValue('B1', 'Name Task')
            ->setCellValue('C1', 'Detik Task')
            ->setCellValue('D1', 'Priority')
            ->setCellValue('E1', 'Duration')
            ->setCellValue('F1', 'Assign to')
            ->setCellValue('G1', 'Information')
            ->setCellValue('H1', 'Progress');

        $baris = 2;
        $no = 1;

        foreach ($data['task'] as $t) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $baris, $no++)
                ->setCellValue('B' . $baris, $t->name)
                ->setCellValue('C' . $baris, $t->detik)
                ->setCellValue('D' . $baris, $t->priority)
                ->setCellValue('E' . $baris, $t->duration)
                ->setCellValue('F' . $baris, $t->assign)
                ->setCellValue('G' . $baris, $t->info)
                ->setCellValue('H' . $baris, $t->progress);

            $baris++;
            $no++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="List_Task.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function pdf()
    {
        $this->load->library('dompdf_gen');

        $data['task'] = $this->task_model->getAll();

        $this->load->view('task/listtask_pdf', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("List Task.pdf", array('Attachment' => 0));
    }
}
