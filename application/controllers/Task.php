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

    public function update()
    {
        $data['title'] = 'Update';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->model('Task_model', 'update');

        $data['update'] = $this->db->get('user_task')->result_array();

        $this->form_validation->set_rules('progress', 'Progress', 'required|trim');
        // $this->form_validation->set_rules('status', 'Status');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('task/update', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'progress' => $this->input->post('progress')
                // 'status' => $this->input->post('status')
            ];

            $this->db->insert('user_task', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update has been saved!</div>');
            redirect('task');
        }
    }
}
