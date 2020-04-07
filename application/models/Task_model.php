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
    public $duration;
    public $assign;
    public $info;

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
                'label' => 'detik',
                'rules' => 'required'
            ],

            [
                'field' => 'priority',
                'label' => 'Priority',
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

    public function getAllUser(){
        $query = $this->db->query('SELECT name FROM user where role_id = 2');
        return $query->result();
    }
    

    public function save()
    {
        $post = $this->input->post();
        $this->id = uniqid();
        $this->name = $post["name"];
        $this->detik = $post["detik"];
        $this->priority = $post["priority"];
        $this->duration = $post["duration"];
        $this->assign = $post["assign"];
        $this->info = $post["info"];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->id = $post["id"];
        $this->name = $post["name"];
        $this->detik = $post["detik"];
        $this->priority = $post["priority"];
        $this->duration = $post["duration"];
        $this->assign = $post["assign"];
        $this->info = $post["info"];
        return $this->db->update($this->_table, $this, array('id' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }
}
