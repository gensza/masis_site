<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataUsers extends CI_Controller
{
    public function __construct()
    {
        // menjalankan method ketika class Auth dijalankan
        parent::__construct();
        $this->load->library('form_validation');
        if (!$this->session->userdata('username')) {
            redirect('Auth');
        }
        // if (!$this->session->userdata('userlogin')) {
        //     redirect('http://mips.msalgroup.com/msal-login/');
        // }
    }

    public function index()
    {
        $db2 = $this->load->database('db2', TRUE);

        $data['title'] = 'Data Users';
        $data['users'] = $this->db->get('tb_users')->result_array();

        $data['users_ho'] = $db2->get('user_ho')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/data_users', $data);
        $this->load->view('templates/footer');
    }

    // public function deleteUser($id)
    // {
    //     $cek = $this->db->get_where('tb_lend_assets', ['users_id' => $id])->num_rows();
    //     if ($cek > 0) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Cant delete, User pernah meminjam aset!</div>');
    //         redirect('DataUsers');
    //     } else {
    //         $this->db->where('id_users', $id);
    //         $this->db->delete('tb_users');
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Data user has been deleted successfully!</div>');
    //         redirect('DataUsers');
    //     }
    // }

    // public function addUsers()
    // {
    //     if ($this->input->post('position') == null) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Position Required</div>');
    //         redirect('DataUsers');
    //     } else {
    //         $data = [
    //             'name' => $this->input->post('name'),
    //             'department' => $this->input->post('dept'),
    //             'position' => $this->input->post('position'),
    //             'is_active' => 1,
    //             'date_created' => time()
    //         ];
    //         $this->db->insert('tb_users', $data);
    //         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Users has been registered successfully!</div>');
    //         redirect('DataUsers');
    //     }
    // }
}
