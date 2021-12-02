<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PermintaanPengembalian extends CI_Controller
{
    public function __construct()
    {
        // menjalankan method ketika class Auth dijalankan
        parent::__construct();
        $db_pt = check_db_pt();

        $this->db_masis_pt = $this->load->database('db_masis_' . $db_pt, TRUE);

        $this->load->library('form_validation');

        // for SSO
        // if (!$this->session->userdata('userlogin')) {
        //     redirect('http://mips.msalgroup.com/msal-login/');
        // }

        if (!$this->session->userdata('username')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = "Permintaan Pengembalian";
        $this->db_masis_pt->select('*');
        $this->db_masis_pt->from('tb_lend_assets');
        $this->db_masis_pt->join('tb_assets', 'tb_assets.id_assets = tb_lend_assets.assets_id', 'left');
        // $this->db_masis_pt->join('tb_users', 'tb_users.id_users = tb_lend_assets.users_id', 'left');
        $this->db_masis_pt->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_lend_assets.qty_id', 'left');
        $this->db_masis_pt->where('lend_status', 2);
        $this->db_masis_pt->order_by('id_lend', 'DESC');
        $data['assets'] = $this->db_masis_pt->get()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/permintaan_pengembalian', $data);
        $this->load->view('templates/footer');
    }

    public function cancelReturn($id_lend)
    {
        $this->db_masis_pt->set('date_return', 0);
        $this->db_masis_pt->set('lend_status', 1, FALSE);
        $this->db_masis_pt->where('id_lend', $id_lend);
        $this->db_masis_pt->update('tb_lend_assets');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Assets has been successfully Canceled!</div>');
        redirect('PermintaanPengembalian');
    }

    public function pengembalianAssets($id_lend, $id_assets, $id_qty)
    {
        $this->db_masis_pt->set('lend_status', '0', FALSE);
        $this->db_masis_pt->where('id_lend', $id_lend);
        $this->db_masis_pt->update('tb_lend_assets');
        $this->db_masis_pt->set('status_unit', '1', FALSE);
        $this->db_masis_pt->set('idle', 'on');
        $this->db_masis_pt->where('id_assets', $id_assets);
        $this->db_masis_pt->update('tb_assets');
        $this->db_masis_pt->set('tersedia', 'tersedia+1', FALSE);
        $this->db_masis_pt->where('id_qty', $id_qty);
        $this->db_masis_pt->update('tb_qty_assets');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Assets has been returned successfully!</div>');
        redirect('PermintaanPengembalian');
    }
}
