<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PermintaanPeminjaman extends CI_Controller
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
        $data['title'] = "Permintaan Peminjaman";
        $this->db_masis_pt->select('*');
        $this->db_masis_pt->from('tb_lend_assets');
        // $this->db_masis_pt->join('tb_assets', 'tb_assets.id_assets = tb_lend_assets.assets_id');
        // $this->db_masis_pt->join('tb_users', 'tb_users.id_users = tb_lend_assets.users_id');
        $this->db_masis_pt->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_lend_assets.qty_id');
        $this->db_masis_pt->where(['lend_status' => 0, 'apprvd_y_dept' => 0, 'apprvd_mis_dept' => 0]);
        $this->db_masis_pt->order_by('id_lend', 'DESC');
        $data['assets'] = $this->db_masis_pt->get()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/permintaan_peminjaman', $data);
        $this->load->view('templates/footer');
    }

    public function formAssets($id_lend, $qty_id, $nama)
    {
        $data['title'] = "Form Assets";
        $data['id_lend'] = $id_lend;
        $data['nama'] = $nama;
        $data['qty_id'] = $qty_id;
        // $data['users'] = $this->db_masis_pt->get_where('tb_users', ['id_users' => $users_id])->row_array();
        $data['category'] = $this->db_masis_pt->get_where('tb_qty_assets', ['id_qty' => $qty_id])->row_array();
        $query = "SELECT tb_assets .*, tb_qty_assets.category 
        FROM tb_assets JOIN tb_qty_assets
        ON tb_assets.qty_id = tb_qty_assets.id_qty
        WHERE status_unit = 1 AND kondisi = 1 AND idle ='on' AND qty_id = $qty_id
        ORDER BY id_assets DESC";
        $data['assets']  = $this->db_masis_pt->query($query)->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/form_assets', $data);
        $this->load->view('templates/footer');
    }

    public function detailPeminjaman($id_assets, $id_lend, $nama)
    {
        $data['title'] = "Detail Pinjaman";
        $data['nama'] = $nama;
        $this->db_masis_pt->select('*');
        $this->db_masis_pt->from('tb_assets');
        $this->db_masis_pt->join('tb_qty_assets', 'tb_qty_assets.id_qty = tb_assets.qty_id');
        $this->db_masis_pt->where(['id_assets' => $id_assets]);
        $data['asset'] = $this->db_masis_pt->get()->result_array();
        // $data['user'] = $this->db_masis_pt->get_where('tb_users', ['id_users' => $users_id])->result_array();
        $data['trx'] = $this->db_masis_pt->get_where('tb_lend_assets', ['id_lend' => $id_lend])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/detail_peminjaman', $data);
        $this->load->view('templates/footer');
    }

    public function trxLend()
    {
        $data = [
            'id_lend' => $this->input->post('id_lend'),
            'assets_id' => $this->input->post('id_assets'),
            'nama' => $this->input->post('id_users'),
            'qty_id' => $this->input->post('qty_id'),
            'date_lend' => $this->input->post('date_lend'),
            'due_date' => $this->input->post('date_return'),
            'date_return' => 0,
            'notes' => $this->input->post('notes'),
            'apprvd_y_dept' => $this->input->post('dept_pem'),
            'apprvd_mis_dept' => $this->input->post('dept_mis'),
            'lend_status' => 1
        ];
        if ($data['apprvd_y_dept'] == 0 and $data['apprvd_mis_dept'] == 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Approve department Peminjam and Department MIS is required!</div>');
            redirect('PermintaanPeminjaman/detailPeminjaman/' . $data['assets_id'] . '/' . $data['id_lend'] . '/' . $data['nama']);
        } elseif ($data['apprvd_y_dept'] == 2 and $data['apprvd_mis_dept'] == 2) {
            $this->db_masis_pt->set('notes', $data['notes']);
            $this->db_masis_pt->set('apprvd_y_dept', $data['apprvd_y_dept'], FALSE);
            $this->db_masis_pt->set('apprvd_mis_dept', $data['apprvd_mis_dept'], FALSE);
            $this->db_masis_pt->where('id_lend', $data['id_lend'], FALSE);
            $this->db_masis_pt->update('tb_lend_assets');
        } elseif ($data['apprvd_y_dept'] != $data['apprvd_mis_dept']) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Approve department Peminjam and Department MIS cant be any different!</div>');
            redirect('PermintaanPeminjaman/detailPeminjaman/' . $data['assets_id'] . '/' . $data['id_lend'] . '/' . $data['nama']);
        } else {
            $this->db_masis_pt->set('assets_id', $data['assets_id'], FALSE);
            $this->db_masis_pt->set('notes', $data['notes']);
            $this->db_masis_pt->set('apprvd_y_dept', $data['apprvd_y_dept'], FALSE);
            $this->db_masis_pt->set('apprvd_mis_dept', $data['apprvd_mis_dept'], FALSE);
            $this->db_masis_pt->set('lend_status', 1, FALSE);
            $this->db_masis_pt->where('id_lend', $data['id_lend'], FALSE);
            $this->db_masis_pt->update('tb_lend_assets');
            $this->db_masis_pt->set('status_unit', 0, FALSE);
            $this->db_masis_pt->set('idle', 0, FALSE);
            $this->db_masis_pt->where('id_assets', $data['assets_id']);
            $this->db_masis_pt->update('tb_assets');
            $this->db_masis_pt->set('tersedia', 'tersedia-1', FALSE);
            $this->db_masis_pt->where('id_qty', $data['qty_id']);
            $this->db_masis_pt->update('tb_qty_assets');
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Permintaan peminjaman berhasil di Approved!</div>');
        redirect('PermintaanPeminjaman');
    }

    public function tolakPermintaan($id)
    {
        $this->db_masis_pt->set('date_return', 0);
        $this->db_masis_pt->set('lend_status', 3, FALSE);
        $this->db_masis_pt->where('id_lend', $id);
        $this->db_masis_pt->update('tb_lend_assets');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">request has been successfully canceled!</div>');
        redirect('PermintaanPeminjaman');
    }
}
