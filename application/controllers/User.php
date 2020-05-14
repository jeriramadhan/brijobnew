<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //cek jika ada gambar yang akan diakses

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Current Password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    //password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Changed!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function myTask()
    {
        $data['title'] = 'List Task';
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $nama = $user['name'];
        $data['kerjaan'] = $this->task_model->getKerjaanUser($nama);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/mytask', $data);
        $this->load->view('templates/footer');
    }

    public function createTask()
    {
        $data['title'] = 'Create Task';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['getUser'] = $this->task_model->getAllUser();

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/createtask', $data);
            $this->load->view('templates/footer');
        } else {
            $data['createTask'] = $this->task_model->getAll();
            $data['getUser'] = $this->task_model->getAllUser();
            $this->load->view('task', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Create task has been saved!</div>');
        }
    }

    // public function updateTask()
    // {
    //     $data['title'] = 'Update';
    //     $nama2 = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    //     $nama = $nama2['name'];

    //     $this->load->model('Task_model', 'update');

    //     $data['update'] = $this->db->get('user_task')->result_array();

    //     $this->form_validation->set_rules('progress', 'Progress', 'required|trim');
    //     // $this->form_validation->set_rules('status', 'Status');


    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('user/updateTask', $data);
    //         $this->load->view('templates/footer');
    //     } else {

    //         $data = array(
    //             'progress' => $this->input->post('progress'),
    //             'status' => $this->input->post('status')
    //         );
    //         // $progress = $this->input->post('progress');
    //         // $status = $this->input->post('status');
    //         $this->db->set($data);
    //         // $this->db->set('status', $status);
    //         $this->db->where('name', $nama);
    //         $this->db->update('user_task');

    //         // $this->db->insert('user_task', $data);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update has been saved!</div>');
    //         redirect('user/mytask');
    //     }
    // }

    public function editTask($id)
    {
        $data['title'] = 'Update';
        $nama2 = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $nama = $nama2['name'];


        // $this->load->model('Task_model', 'update');

        $where = array('id' => $id);
        $data['progress'] = $this->task_model->ambil_where($where, 'user_task')->result();
        $data['info'] = $this->task_model->ambil_where($where, 'user_task')->result();
        $data['attach'] = $this->task_model->ambil_where($where, 'user_task')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/update', $data);
        $this->load->view('templates/footer');
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
        redirect('user/mytask');
    }

    public function approval()
    {
        $data['title'] = 'Create Task';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['getGh'] = $this->task_model->getGh();
        $data['getUser'] = $this->task_model->getAllUser();

        $task = $this->task_model;
        $validation = $this->form_validation;
        $validation->set_rules($task->rules());

        if ($validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/approval', $data);
            $this->load->view('templates/footer');
        } else {
            $task->save();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Approval has been saved!</div>');
            redirect('user/approval');
        }
    }
}
