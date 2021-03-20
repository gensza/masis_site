<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        // menjalankan method ketika class Auth dijalankan
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $db2 = $this->load->database('db2', TRUE);

        $data['title'] = 'Pinjam Assets';
        $this->db->select('*');
        $this->db->from('tb_lend_assets');
        $this->db->join('tb_assets', 'tb_assets.id_assets = tb_lend_assets.assets_id', 'left');
        // $this->db->join('tb_users', 'tb_users.id_users = tb_lend_assets.users_id', 'left');
        $this->db->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_lend_assets.qty_id', 'left');
        $this->db->order_by('id_lend', 'DESC');
        $data['assets'] = $this->db->get()->result_array();
        $data['users_ho'] = $db2->get('user_ho')->result_array();
        $data['category'] = $this->db->get('tb_qty_assets')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('users/pinjam_assets', $data);
        $this->load->view('templates/footer');
    }

    public function trx()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->form_validation->set_rules('id_user', 'Name', 'required|trim');
        $this->form_validation->set_rules('id_qty', 'Category', 'required|trim');
        $this->form_validation->set_rules('notes_user', 'Keterangan', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $data = [
                'assets_id' => 0,
                'nama' => $this->input->post('id_user'),
                'qty_id' => $this->input->post('id_qty'),
                'date_lend' => $this->input->post('date_lend'),
                'due_date' => $this->input->post('date_return'),
                'date_return' => 0,
                'notes' => 0,
                'notes_user' => $this->input->post('notes_user'),
                'apprvd_y_dept' => 0,
                'apprvd_mis_dept' => 0,
                'lend_status' => 0
            ];
            $this->db->insert('tb_lend_assets', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your request has been successfully!</div>');
            redirect('Users');
        }
    }

    public function cancelRequest($id)
    {
        $this->db->set('date_return', 0);
        $this->db->set('lend_status', 3, FALSE);
        $this->db->where('id_lend', $id);
        $this->db->update('tb_lend_assets');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your request has been successfully canceled!</div>');
        redirect('Users');
    }

    public function approveReturn($id)
    {
        $this->db->set('date_return', date("Y-m-d h:i:s"));
        $this->db->set('lend_status', 2, FALSE);
        $this->db->where('id_lend', $id);
        $this->db->update('tb_lend_assets');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Assets has been successfully! returned</div>');
        redirect('Users');
    }
}
