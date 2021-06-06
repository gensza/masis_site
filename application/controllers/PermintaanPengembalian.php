<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PermintaanPengembalian extends CI_Controller
{
    public function __construct()
    {
        // menjalankan method ketika class Auth dijalankan
        parent::__construct();
        $this->load->library('form_validation');

        // for SSO
        // if (!$this->session->userdata('userlogin')) {
        //     redirect('http://mips.msalgroup.com/msal-login/');
        // }

        if (!$this->session->userdata('email')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = "Permintaan Pengembalian";
        $this->db->select('*');
        $this->db->from('tb_lend_assets');
        $this->db->join('tb_assets', 'tb_assets.id_assets = tb_lend_assets.assets_id', 'left');
        // $this->db->join('tb_users', 'tb_users.id_users = tb_lend_assets.users_id', 'left');
        $this->db->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_lend_assets.qty_id', 'left');
        $this->db->where('lend_status', 2);
        $this->db->order_by('id_lend', 'DESC');
        $data['assets'] = $this->db->get()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/permintaan_pengembalian', $data);
        $this->load->view('templates/footer');
    }

    public function cancelReturn($id_lend)
    {
        $this->db->set('date_return', 0);
        $this->db->set('lend_status', 1, FALSE);
        $this->db->where('id_lend', $id_lend);
        $this->db->update('tb_lend_assets');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Assets has been successfully Canceled!</div>');
        redirect('PermintaanPengembalian');
    }

    public function pengembalianAssets($id_lend, $id_assets, $id_qty)
    {
        $this->db->set('lend_status', '0', FALSE);
        $this->db->where('id_lend', $id_lend);
        $this->db->update('tb_lend_assets');
        $this->db->set('status_unit', '1', FALSE);
        $this->db->set('idle', 'on');
        $this->db->where('id_assets', $id_assets);
        $this->db->update('tb_assets');
        $this->db->set('tersedia', 'tersedia+1', FALSE);
        $this->db->where('id_qty', $id_qty);
        $this->db->update('tb_qty_assets');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Assets has been returned successfully!</div>');
        redirect('PermintaanPengembalian');
    }
}
