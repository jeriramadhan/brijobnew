<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Task_model extends CI_Model
{
    private $_table = "user_task";
    private $table_user = "user";

    public $id;
    public $name;
    public $detik;
    public $attach = "default.pdf";
    public $priority;
    public $startdate;
    public $duration;
    public $assign;
    // public $info;

    public function rules()
    {
        return [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            ],

            [
                'field' => 'detik',
                'label' => 'Detik',
                'rules' => 'required'
            ],

            [
                'field' => 'priority',
                'label' => 'Priority',
                'rules' => 'required'
            ],

            [
                'field' => 'startdate',
                'label' => 'Start Date',
                'rules' => 'required'
            ],
            [
                'field' => 'duration',
                'label' => 'Duration',
                'rules' => 'required'
            ],

            [
                'field' => 'assign',
                'label' => 'Assign',
                'rules' => 'required'
            ]
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }

    public function getAllUser()
    {
        $query = $this->db->query('SELECT name FROM user where role_id = 3');
        return $query->result();
    }

    public function getGh()
    {
        $query = $this->db->query('SELECT * FROM user where role_id = 2');
        return $query->result();
    }

    public function getKerjaanUser($nama)
    {
        $query = $this->db->query('SELECT * FROM user_task where approve = "Approved" or assign = "' . $nama . '"');
        return $query->result();
    }

    public function getApprove($approve)
    {
        $query = $this->db->query('SELECT * FROM user_task where assign = "' . $approve . '"');
        return $query->result();
    }


    public function save()
    {
        $post = $this->input->post();
        $this->id = uniqid();
        $this->name = $post["name"];
        $this->detik = $post["detik"];
        $this->attach = $this->_uploadFile();
        $this->priority = $post["priority"];
        $this->startdate = $post["startdate"];
        $this->duration = $post["duration"];
        $this->assign = $post["assign"];
        // $this->info = $post["info"];
        return $this->db->insert($this->_table, $this);
    }

    // public function update()
    // {
    //     $post = $this->input->post();
    //     $this->id = $post["id"];
    //     $this->name = $post["name"];
    //     $this->detik = $post["detik"];
    //     $this->priority = $post["priority"];
    //     $this->duration = $post["duration"];
    //     $this->assign = $post["assign"];
    //     $this->info = $post["info"];
    //     return $this->db->update($this->_table, $this, array('id' => $post['id']));
    //     $query = $this->db->query('SELECT progress FROM user_task');
    //     return $query->result();
    // }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }

    private function _uploadFile()
    {
        $config['upload_path']          = './assets/img/file/';
        $config['allowed_types']        = 'pdf|docx|jpg|xlsx';
        // $config['file_name']            = $this->id;
        $config['overwrite']            = true;
        $config['max_size']             = 0; // 1MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('attach')) {
            return $this->upload->data("file_name");
        }

        return "default.pdf";
    }

    public function ambil_where($where, $_table)
    {
        return $this->db->get_where($_table, $where);
    }

    public function update($where, $data, $_table)
    {
        $this->db->where($where);
        $this->db->update($_table, $data);
    }

    public function insertgh($data)
    {
        $this->db->insert('user', $data);
    }

    public function view_data()
    {
        return $this->db->get('user_task');
    }
}
