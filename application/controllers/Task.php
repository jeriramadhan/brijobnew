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
            redirect(site_url('task'));
        }
    }

    public function requesttask()
    {
        $data['title'] = 'Approval';
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $nama = $user['name'];
        $data['kerjaan'] = $this->task_model->getKerjaanUser($nama);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('task/requesttask', $data);
        $this->load->view('templates/footer');
    }

    public function accept($id)
    {
        $data['title'] = 'Approval';
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

    // public function print()
    // {
    //     $data['task'] = $this->task_model->getAll();
    //     $this->load->view('task/printtask', $data);
    // }

    public function excel()
    {
        $data['task'] = $this->task_model->getAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', '#')
            ->setCellValue('B1', 'Name Task')
            ->setCellValue('C1', 'Detik Task')
            ->setCellValue('D1', 'Priority')
            ->setCellValue('E1', 'Start Date')
            ->setCellValue('F1', 'End Date')
            ->setCellValue('G1', 'Assign to')
            ->setCellValue('H1', 'Information')
            ->setCellValue('I1', 'Progress');

        $baris = 2;
        $no = 1;

        foreach ($data['task'] as $t) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $baris, $no++)
                ->setCellValue('B' . $baris, $t->name)
                ->setCellValue('C' . $baris, $t->detik)
                ->setCellValue('D' . $baris, $t->priority)
                ->setCellValue('E' . $baris, $t->startdate)
                ->setCellValue('F' . $baris, $t->duration)
                ->setCellValue('G' . $baris, $t->assign)
                ->setCellValue('H' . $baris, $t->info)
                ->setCellValue('I' . $baris, $t->progress);

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
        // $this->load->library('dompdf_gen');

        // $data['task'] = $this->task_model->getAll();

        // $this->load->view('task/listtask_pdf', $data);

        // $paper_size = 'A4';
        // $orientation = 'landscape';
        // $html = $this->output->get_output();
        // $this->dompdf->set_paper($paper_size, $orientation);

        // $this->dompdf->load_html($html);
        // $this->dompdf->render();
        // $this->dompdf->stream("List Task.pdf", array('Attachment' => 0));



        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintFooter(false);
        $pdf->setPrintHeader(false);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->AddPage('');
        $pdf->Write(0, 'BRIJOB', '', 0, 'L', true, 0, false, false, 0);
        $pdf->SetFont('');

        $data['task'] = $this->task_model->getAll();

        $pdf->writeHTML($data);
        $pdf->Output('file-pdf-codeigniter.pdf', 'I');
    }
}
