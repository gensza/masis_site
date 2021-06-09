<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        // menjalankan method ketika class Auth dijalankan
        parent::__construct();

        // FOR SSO
        // if (!$this->session->userdata('userlogin')) {
        //     redirect('http://mips.msalgroup.com/msal-login/');
        // }

        if (!$this->session->userdata('username')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = "Dashboard";

        $this->db->select('*');
        $this->db->from('tb_lend_assets');
        $this->db->join('tb_assets', 'tb_assets.id_assets = tb_lend_assets.assets_id', 'left');
        // $this->db->join('tb_users', 'tb_users.id_users = tb_lend_assets.users_id', 'left');
        $this->db->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_lend_assets.qty_id', 'left');
        $this->db->order_by('id_lend', 'DESC');
        $data['assets'] = $this->db->get()->result_array();

        $data['qty_assets'] = $this->db->get('tb_qty_assets')->result_array();

        $this->db->from('tb_qty_assets');
        $data['category'] = $this->db->count_all_results();

        $this->db->select_sum('qty');
        $query = $this->db->get('tb_qty_assets');
        $data['qty'] = $query->row()->qty;

        $this->db->select_sum('tersedia');
        $query = $this->db->get('tb_qty_assets');
        $data['tersedia'] = $query->row()->tersedia;

        $this->db->where('kondisi', 0);
        $this->db->from('tb_assets');
        $data['rusak'] = $this->db->count_all_results();

        $this->db->where('status_unit', 0);
        $this->db->from('tb_assets');
        $data['dipinjam'] = $this->db->count_all_results();

        $this->db->where('idle', 'on');
        $this->db->from('tb_assets');
        $data['idle_aset'] = $this->db->count_all_results();

        $this->db->where(['apprvd_y_dept' => 1, 'apprvd_mis_dept' => 1, 'lend_status' => 0]);
        $this->db->from('tb_lend_assets');
        $data['return'] = $this->db->count_all_results();

        $this->db->where(['apprvd_y_dept' => 0, 'apprvd_mis_dept' => 0, 'lend_status' => 0]);
        $this->db->from('tb_lend_assets');
        $data['req'] = $this->db->count_all_results();

        $this->db->where(['apprvd_y_dept' => 1, 'apprvd_mis_dept' => 1, 'lend_status' => 2]);
        $this->db->from('tb_lend_assets');
        $data['wait_return'] = $this->db->count_all_results();

        $this->db->where(['apprvd_y_dept' => 2, 'apprvd_mis_dept' => 2, 'lend_status' => 0]);
        $this->db->from('tb_lend_assets');
        $data['rejected'] = $this->db->count_all_results();

        $date_today = date('Y-m-d');
        $this->db->select('id_assets');
        $this->db->where(['status_maintenan' => 0, 'tgl_jadwal_maintenan <=' => $date_today, 'tgl_jadwal_maintenan !=' => '1970-01-01']);
        $this->db->from('tb_assets');
        $data['assets_maintenance'] = $this->db->get()->num_rows();

        $data['assets_data'] = $this->db->get('tb_qty_assets')->result_array();

        $this->db->select('tb_qty_assets.category, COUNT(qty_id) AS total');
        $this->db->from('tb_assets');
        $this->db->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id');
        $this->db->group_by('qty_id');
        $this->db->order_by('total', 'ASC');
        $data['count_assets'] = $this->db->get()->result();
        // var_dump($data['count_assets2']);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/index', $data);
        $this->load->view('templates/footer');
    }
}
