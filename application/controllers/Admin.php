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

        $db_pt = check_db_pt();

        $this->db_masis_pt = $this->load->database('db_masis_' . $db_pt, TRUE);
    }

    public function index()
    {
        $data['title'] = "Dashboard";

        $this->db_masis_pt->select('*');
        $this->db_masis_pt->from('tb_lend_assets');
        $this->db_masis_pt->join('tb_assets', 'tb_assets.id_assets = tb_lend_assets.assets_id', 'left');
        // $this->db_masis_pt->join('tb_users', 'tb_users.id_users = tb_lend_assets.users_id', 'left');
        $this->db_masis_pt->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_lend_assets.qty_id', 'left');
        $this->db_masis_pt->order_by('id_lend', 'DESC');
        $data['assets'] = $this->db_masis_pt->get()->result_array();

        $data['qty_assets'] = $this->db_masis_pt->get('tb_qty_assets')->result_array();

        $this->db_masis_pt->from('tb_qty_assets');
        $data['category'] = $this->db_masis_pt->count_all_results();

        $this->db_masis_pt->select_sum('qty');
        $query = $this->db_masis_pt->get('tb_qty_assets');
        $data['qty'] = $query->row()->qty;

        // $this->db_masis_pt->select_sum('tersedia');
        // $query = $this->db_masis_pt->get('tb_qty_assets');
        // $data['tersedia'] = $query->row()->tersedia;

        $this->db_masis_pt->where('idle !=', 'on');
        $this->db_masis_pt->or_where('idle ', NULL);
        $this->db_masis_pt->from('tb_assets');
        $data['terpakai'] = $this->db_masis_pt->count_all_results();

        $this->db_masis_pt->where('kondisi', 0);
        $this->db_masis_pt->from('tb_assets');
        $data['rusak'] = $this->db_masis_pt->count_all_results();

        $this->db_masis_pt->where('status_unit', 0);
        $this->db_masis_pt->from('tb_assets');
        $data['dipinjam'] = $this->db_masis_pt->count_all_results();

        $this->db_masis_pt->where('idle', 'on');
        $this->db_masis_pt->from('tb_assets');
        $data['idle_aset'] = $this->db_masis_pt->count_all_results();

        $this->db_masis_pt->where(['apprvd_y_dept' => 1, 'apprvd_mis_dept' => 1, 'lend_status' => 0]);
        $this->db_masis_pt->from('tb_lend_assets');
        $data['return'] = $this->db_masis_pt->count_all_results();

        $this->db_masis_pt->where(['apprvd_y_dept' => 0, 'apprvd_mis_dept' => 0, 'lend_status' => 0]);
        $this->db_masis_pt->from('tb_lend_assets');
        $data['req'] = $this->db_masis_pt->count_all_results();

        $this->db_masis_pt->where(['apprvd_y_dept' => 1, 'apprvd_mis_dept' => 1, 'lend_status' => 2]);
        $this->db_masis_pt->from('tb_lend_assets');
        $data['wait_return'] = $this->db_masis_pt->count_all_results();

        $this->db_masis_pt->where(['apprvd_y_dept' => 2, 'apprvd_mis_dept' => 2, 'lend_status' => 0]);
        $this->db_masis_pt->from('tb_lend_assets');
        $data['rejected'] = $this->db_masis_pt->count_all_results();

        $date_today = date('Y-m-d');
        $this->db_masis_pt->select('id_assets');
        $this->db_masis_pt->where(['status_maintenan' => 0, 'tgl_jadwal_maintenan <=' => $date_today, 'tgl_jadwal_maintenan !=' => '1970-01-01']);
        $this->db_masis_pt->from('tb_assets');
        $data['assets_maintenance'] = $this->db_masis_pt->get()->num_rows();

        $data['assets_data'] = $this->db_masis_pt->get('tb_qty_assets')->result_array();

        $this->db_masis_pt->select('tb_qty_assets.category, COUNT(qty_id) AS total');
        $this->db_masis_pt->from('tb_assets');
        $this->db_masis_pt->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id');
        $this->db_masis_pt->group_by('qty_id');
        $this->db_masis_pt->order_by('total', 'ASC');
        $data['count_assets'] = $this->db_masis_pt->get()->result();
        // var_dump($data['count_assets2']);
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/index', $data);
        $this->load->view('templates/footer');
    }
}
