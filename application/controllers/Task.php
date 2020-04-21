<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
        $data['title'] = 'Task';
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

        if ('dateinput == datenow') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Duration task is still 3 days left!</div>');
        } elseif ('dateinput == (datenow - 1)') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Duration task is still 2 days left!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Duration task is still 1 days left!</div>');
        }

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

    public function delete($id = null)
    {
        if (!isset($id)) show_404();

        if ($this->task_model->delete($id)) {
            redirect(site_url('task/listask'));
        }
    }

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
}
